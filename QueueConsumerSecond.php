<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$conn = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost',5672,'guest', 'guest');

$channel = $conn->channel();

$channel->basic_consume('Queue-1', '', false, true, false, false, function ($msg){
    echo 'Message Received :', $msg->body, "\n";
});

while (true) {
    $channel->wait();
}

$channel->close();

