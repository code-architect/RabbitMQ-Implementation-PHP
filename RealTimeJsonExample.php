<?php

require_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';


// Get the object of amqp object connection
$conn = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost',5672,'guest', 'guest');

// object of channel
$channel = $conn->channel();

$message->to      = 'to-address';
$message->from    = 'from_address';
$message->subject = 'Subject to mail';

// object of maqp message
$msg = new \PhpAmqpLib\Message\AMQPMessage(json_encode($message));

$channel->basic_publish($msg, '', 'Queue-1');

$channel->close();
$conn->close();

echo $message;