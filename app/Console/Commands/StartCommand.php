<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда для старта проекта убедитесь в правильности подключения БД';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('serve');

        $this->info('Migrations refreshed and seeds executed successfully!');
    }
}
