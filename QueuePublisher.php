<?php

require_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$messageStr = $_GET['message'];

// Get the object of amqp object connection
$conn = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost',5672,'guest', 'guest');

// object of channel
$channel = $conn->channel();

// object of maqp message
$msg = new \PhpAmqpLib\Message\AMQPMessage($messageStr);

$channel->basic_publish($msg, '', 'Queue-1');

$channel->close();
$conn->close();

echo $messageStr;