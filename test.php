<?php
require 'vendor/autoload.php';

use React\EventLoop\Factory as LoopFactory;
use React\Socket\Server as SocketServer;
use React\Http\Server as HttpServer;

$loop = LoopFactory::create();

$server = new HttpServer(function ($request, $response) {
    try {
        $response->writeHead(200, array('Content-Type' => 'text/plain'));
        $response->end("Hello, World!\n");
    } catch (Exception $e) {
        $response->writeHead(500, array('Content-Type' => 'text/plain'));
        $response->end("Internal Server Error: " . $e->getMessage() . "\n");
    }
});

$socket = new SocketServer('0.0.0.0:8787', $loop);
$server->listen($socket);

echo "Server running at http://0.0.0.0:8787\n";

$loop->run();
