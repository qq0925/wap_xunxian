<?php
require __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/../../class/autoreact.php';

$loop = React\EventLoop\Factory::create();

$loop->addPeriodicTimer(60, function () {
    player_minute();
});

$loop->run();