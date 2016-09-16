<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
class Ws extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ws {status : start|stop|restart|status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $status = $this -> argument('status');


        $app_work = new AppWorker("websocket://0.0.0.0:2346");

        switch ($status){
            case 'start':
                /** @var AppWorker $app_work */

                // Hack Run worker
                
        }
        $app_work -> args($status, true, $this -> getName());
        $app_work -> runAll();
        /** @var AppWorker $app_work */
    }
}
