<?php

require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$messageStr = "hello I am fanout exchange";

$conn = new AMQPStreamConnection('localhost', '5672', 'guest', 'guest');

$channel = $conn->channel();

$msg = new AMQPMessage($messageStr);

$channel->basic_publish($msg, 'Fanout-Exchange-Architect', '');

$channel->close();
$conn->close();

echo "Message Published to Fanout-Exchange-Architect";