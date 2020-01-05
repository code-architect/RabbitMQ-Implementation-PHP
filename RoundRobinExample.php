<?php

require_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

// Get the object of amqp object connection
$conn = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost',5672,'guest', 'guest');

// object of channel
$channel = $conn->channel();
$faker = Faker\Factory::create();
for($i=0; $i<10000; $i++)
{
    $messages[] = $faker->name;
}

foreach ($messages as $message)
{
    $msg = new \PhpAmqpLib\Message\AMQPMessage($message);
    $channel->basic_publish($msg, '', 'Queue-1');
}

$channel->close();
$conn->close();

echo "Four messages published";