<?php

namespace App\Console\Commands;

namespace App\Console\Commands;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use App\WebSocket\AirtcleController;
use Illuminate\Console\Command;
use Ratchet\WebSocket\WsServer;

class Ws extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ws';

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
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new AirtcleController
                )
            ),
            8080
        );

        $this -> info('ws server start runtime');
        $server->run();
        $this -> warn('ws server runtime close');
    }
}
