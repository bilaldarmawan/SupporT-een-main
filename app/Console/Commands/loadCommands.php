<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LoadCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:load-commands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load custom commands from specified directories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Loading commands from app/Http/Commands...');
        $this->call('optimize:clear'); // Contoh pemanggilan command lain

        $this->info('Commands loaded successfully.');
    }
}

