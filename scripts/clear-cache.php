<?php

require __DIR__.'/../vendor/autoload.php';

try {
    $client = new Predis\Client(getenv('REDIS_CONN_STR') == false ? 'redis://cache:6379' : getenv('REDIS_CONN_STR'));
    $client->connect();
    $client->flushall();
    exit(0);
} catch (Exception $e) {
    $logPayload = json_encode([
        "msg" => $e->getMessage(),
        "data" => getenv('REDIS_CONN_STR') == false ? 'redis://cache:6379' : getenv('REDIS_CONN_STR')
    ]);
    // log to stderr
    file_put_contents('php://stderr', $logPayload);
    exit(1);
}
