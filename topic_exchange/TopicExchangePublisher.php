<?php

require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$messageStr = "hello I am topic exchange";

$conn = new AMQPStreamConnection('localhost', '5672', 'guest', 'guest');

$channel = $conn->channel();

$msg = new AMQPMessage($messageStr);

$channel->basic_publish($msg, 'Topic-Exchange-Architect', 'tv.mobile.ac');

$channel->close();
$conn->close();

echo "Message Published to Topic-Exchange-Architect";