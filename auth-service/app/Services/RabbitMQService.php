<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    public function publish($queue, $message)
    {
        $connection = new AMQPStreamConnection(env('RABBITMQ_HOST'), 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare($queue, false, false, false, false);

        $msg = new AMQPMessage($message);
        $channel->basic_publish($msg, '', $queue);

        $channel->close();
        $connection->close();
    }
}
