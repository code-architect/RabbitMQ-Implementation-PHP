<?php

require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use \PhpAmqpLib\Wire\AMQPTable;

$messageStr = "I am from Headers exchange";

$conn = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $conn->channel();

$headerValues = array('item1' => 'mobile','item2' => 'television');

// cannot pass headers with the message, so we need AMQPTable to pass the
$headers = new AMQPTable($headerValues);

$message = new AMQPMessage($messageStr);
// we need to use this specific key to set the header in our message
$message->set('application_headers', $headers);

$channel->basic_publish($message, 'Headers-Exchange-Architect','');
$channel->close();
$conn->close();
echo "Message delivered";