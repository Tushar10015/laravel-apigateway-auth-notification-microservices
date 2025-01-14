<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use PhpAmqpLib\Message\AMQPMessage;
use App\Services\RabbitMQService;

class SendLoginEvent implements ShouldQueue
{
    use Queueable;

    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function handle()
    {
        $rabbitMQ = new RabbitMQService();
        $rabbitMQ->publish('auth_events', json_encode(['email' => $this->email, 'event' => 'login']));
    }
}
