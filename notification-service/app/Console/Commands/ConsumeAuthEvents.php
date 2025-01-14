<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ConsumeAuthEvents extends Command
{
    protected $signature = 'consume:auth-events';
    protected $description = 'Consume authentication events from RabbitMQ';

    public function handle()
    {
        $connection = new AMQPStreamConnection(env('RABBITMQ_HOST'), 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('auth_events', false, false, false, false);

        $callback = function ($msg) {
            $this->info('Received: ' . $msg->body);
            // Handle the event (e.g., send notification)
        };

        $channel->basic_consume('auth_events', '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }
    }
}
