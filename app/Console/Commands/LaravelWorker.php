<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-09-17
 * Time: 1:47
 */

namespace App\Console\Commands;

use Workerman\Lib\Timer;
use Workerman\Worker;

class LaravelWorker extends Worker
{
    public static $args=[];

    /**
     * @param $args
     */
    public static function args($status, $is_daemon, $name){
        self::$args = [$status, $is_daemon, $name];
    }

    public static function runAll()
    {

        self::checkSapiEnv();
        self::init();
        self::parseCommand();
        self::daemonize();
        self::initWorkers();
        self::installSignal();
        self::saveMasterPid();
        self::forkWorkers();
        self::displayUI();
        self::resetStd();
        self::monitorWorkers();
    }
    /**
     * Parse command.
     * php yourfile.php start | stop | restart | reload | status
     *
     * @return void
     */
    protected static function parseCommand()
    {
        list($status, $is_daemon, $name) = self::$args;
        $start_file = $name;
        if (!isset($status)) {
            exit("Usage: php yourfile.php {start|stop|restart|reload|status|kill}\n");
        }

        // Get command.
        $command  = $status;

        // Start command.
        $mode = '';
        if ($command === 'start') {
            if ($is_daemon) {
                $mode = 'in DAEMON mode';
            } else {
                $mode = 'in DEBUG mode';
            }
        }
        self::log("Workerman[$start_file] $command $mode");

        // Get master process PID.
        $master_pid      = @file_get_contents(self::$pidFile);
        $master_is_alive = $master_pid && @posix_kill($master_pid, 0);
        // Master is still alive?
        if ($master_is_alive) {
            if ($command === 'start') {
                self::log("Workerman[$start_file] already running");
                exit;
            }
        } elseif ($command !== 'start' && $command !== 'restart' && $command !== 'kill') {
            self::log("Workerman[$start_file] not run");
            exit;
        }

        // execute command.
        switch ($command) {
            case 'kill':
                exec("ps aux | grep $start_file | grep -v grep | awk '{print $2}' |xargs kill -SIGINT");
                usleep(100000);
                exec("ps aux | grep $start_file | grep -v grep | awk '{print $2}' |xargs kill -SIGKILL");
                break;
            case 'start':
                if ($is_daemon) {
                    AppWorker::$daemonize = true;
                }
                break;
            case 'status':
                if (is_file(self::$_statisticsFile)) {
                    @unlink(self::$_statisticsFile);
                }
                // Master process will send status signal to all child processes.
                posix_kill($master_pid, SIGUSR2);
                // Waiting amoment.
                usleep(100000);
                // Display statisitcs data from a disk file.
                @readfile(self::$_statisticsFile);
                exit(0);
            case 'restart':
            case 'stop':
                self::log("Workerman[$start_file] is stoping ...");
                // Send stop signal to master process.
                $master_pid && posix_kill($master_pid, SIGINT);
                // Timeout.
                $timeout    = 5;
                $start_time = time();
                // Check master process is still alive?
                while (1) {
                    $master_is_alive = $master_pid && posix_kill($master_pid, 0);
                    if ($master_is_alive) {
                        // Timeout?
                        if (time() - $start_time >= $timeout) {
                            self::log("Workerman[$start_file] stop fail");
                            exit;
                        }
                        // Waiting amoment.
                        usleep(10000);
                        continue;
                    }
                    // Stop success.
                    self::log("Workerman[$start_file] stop success");
                    if ($command === 'stop') {
                        exit(0);
                    }
                    if ($is_daemon) {
                        AppWorker::$daemonize = true;
                    }
                    break;
                }
                break;
            case 'reload':
                posix_kill($master_pid, SIGUSR1);
                self::log("Workerman[$start_file] reload");
                exit;
            default :
                exit("Usage: php yourfile.php {start|stop|restart|reload|status|kill}\n");
        }
    }

    /**
     * Init.
     *
     * @return void
     */
    protected static function init()
    {
        list($status, $is_daemon, $name) = self::$args;
        // Start file.
        self::$_startFile = $name;

        // Pid file.
        if (empty(self::$pidFile)) {
            self::$pidFile = __DIR__ . "/../" . str_replace('/', '_', self::$_startFile) . ".pid";
        }

        // Log file.
        if (empty(self::$logFile)) {
            self::$logFile = __DIR__ . '/../workerman.log';
        }
        touch(self::$logFile);
        chmod(self::$logFile, 0622);

        // State.
        self::$_status = self::STATUS_STARTING;

        // For statistics.
        self::$_globalStatistics['start_timestamp'] = time();
        self::$_statisticsFile                      = sys_get_temp_dir() . '/workerman.status';

        // Process title.
        self::setProcessTitle('WorkerMan: master process  start_file=' . self::$_startFile);

        // Init data for worker id.
        self::initId();

        // Timer init.
        Timer::init();
    }
}