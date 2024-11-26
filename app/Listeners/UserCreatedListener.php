<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Cache;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class UserCreatedListener
{
    protected $connection;
    protected $channel;

    public function __construct()
    {
        $host = env('RABBITMQ_HOST');
        $port = env('RABBITMQ_PORT');
        $user = env('RABBITMQ_USER');
        $password = env('RABBITMQ_PASSWORD');

        $this->connection = new AMQPStreamConnection($host, $port, $user, $password, '/');
        $this->channel = $this->connection->channel();
    }

    public function handle($message)
    {
        $data = json_decode($message->body, true);

        if ($data['event'] === 'UserCreated') {
            Cache::put('users', $data['users'], 1440);
        }
    }

    public function listen()
    {
        $this->channel->queue_declare('user_events', false, true, false, false);

        $callback = function ($msg) {
            $this->handle($msg);
        };

        $this->channel->basic_consume('user_events', '', false, true, false, false, $callback);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}

