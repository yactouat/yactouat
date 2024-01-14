<?php

require __DIR__.'/../vendor/autoload.php';

try {
    $client = new Predis\Client('redis://localhost:6379');
    $client->connect();
    $client->flushall();
} catch (Exception $e) {
    // dev
    $client = new Predis\Client('redis://cache:6379');
    $client->connect();
    $client->flushall();
}
exit(0);
