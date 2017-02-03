<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Psr\Log\LogLevel;
use ReflectionClass;

class TestController extends Controller
{
    private static $levels_classes = [
        'debug' => 'info',
        'info' => 'info',
        'notice' => 'info',
        'warning' => 'warning',
        'error' => 'danger',
        'critical' => 'danger',
        'alert' => 'danger',
        'emergency' => 'danger',
    ];
    private static $levels_imgs = [
        'debug' => 'info',
        'info' => 'info',
        'notice' => 'info',
        'warning' => 'warning',
        'error' => 'warning',
        'critical' => 'warning',
        'alert' => 'warning',
        'emergency' => 'warning',
    ];
    const MAX_FILE_SIZE = 52428800; // Why? Uh... Sorry
    private static $file;
    public static function getFiles($basename = false)
    {
        $files = glob(storage_path() . '/logs/laravel-*');
        $files = array_reverse($files);
        $files = array_filter($files, 'is_file');
        if ($basename && is_array($files)) {
            foreach ($files as $k => $file) {
                $files[$k] = basename($file);
            }
        }
        return array_values($files);
    }
    /**
     * @return array
     */
    private static function getLogLevels()
    {
        $class = new ReflectionClass(new LogLevel);
        return $class->getConstants();
    }
    public static function all()
    {
        $log = array();
        $log_levels = self::getLogLevels();
        $pattern = '/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\].*/';
        if (!self::$file) {
            $log_file = self::getFiles();
            if(!count($log_file)) {
                return [];
            }
            self::$file = $log_file[0];
        }
        if (app('files')->size(self::$file) > self::MAX_FILE_SIZE) return null;
        $file = app('files')->get(self::$file);
        preg_match_all($pattern, $file, $headings);
        if (!is_array($headings)) return $log;
        $log_data = preg_split($pattern, $file);
        if ($log_data[0] < 1) {
            array_shift($log_data);
        }
        foreach ($headings as $h) {
            for ($i=0, $j = count($h); $i < $j; $i++) {
                foreach ($log_levels as $level_key => $level_value) {
                    if (strpos(strtolower($h[$i]), '.' . $level_value)) {
                        preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\].*?(\w+)\.' . $level_key . ': (.*?)( in .*?:[0-9]+)?$/', $h[$i], $current);
                        if (!isset($current[3])) continue;
                        $log[] = array(
                            'context' => $current[2],
                            'level' => $level_value,
                            'level_class' => self::$levels_classes[$level_value],
                            'level_img' => self::$levels_imgs[$level_value],
                            'date' => $current[1],
                            'text' => $current[3],
                            'in_file' => isset($current[4]) ? $current[4] : null,
                            'stack' => preg_replace("/^\n*/", '', $log_data[$i])
                        );
                    }
                }
            }
        }
        return array_reverse($log);
    }
    public function index()
    {
        return self::all();
    }
}
