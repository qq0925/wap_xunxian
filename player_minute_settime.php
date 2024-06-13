<?php
require 'vendor/autoload.php';
require 'class/autoreact.php';

$loop = React\EventLoop\Factory::create();

$loop->addPeriodicTimer(60, function () {
    player_minute();
});

$loop->run();