<?php

namespace App\Console\Commands;

use App\Listeners\UserCreatedListener;
use Illuminate\Console\Command;

class ListenForUserEvents extends Command
{
    protected $signature = 'user:listen';

    protected $description = 'Listen for UserCreated events and process them';

    public function handle()
    {
        $listener = new UserCreatedListener();
        $listener->listen();
    }
}
