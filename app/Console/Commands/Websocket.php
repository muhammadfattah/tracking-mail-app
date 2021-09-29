<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\WebsocketServer;

class Websocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Websocket Server';

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
     * @return int
     */
    public function handle()
    {
        $port = 3000;
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebsocketServer()
                )
            ),
            $port
        );

        $this->info("Websocket is running ...");
        $server->run();
    }
}
