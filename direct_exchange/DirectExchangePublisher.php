<?php

require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// I ma using get for simplicity, it can be anything based on requirements
$messageStr = $_GET['message'];

$conn = new AMQPStreamConnection('localhost', '5672', 'guest', 'guest');

$channel = $conn->channel();

$msg = new AMQPMessage($messageStr);

$channel->basic_publish($msg, 'Direct-Exchange-Architect', 'mobile');

$channel->close();
$conn->close();

echo "Message Published to Direct-Exchange-Architect";