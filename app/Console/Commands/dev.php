<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class dev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('app:install');

        $this->runSeeders();

        $this->call('serve');

    }

    public function runSeeders()
    {
        // $this->write("Rodando o Seeder ParamsSeeder");
        // $this->call('db:seed', ['--class' => 'ParamsSeeder']);
    }

    private function write($text = '')
    {
        print_r(PHP_EOL);
        print_r('------------------------------------------------------------');
        print_r(PHP_EOL);
        print_r($text . PHP_EOL);
        print_r(PHP_EOL);
        print_r('------------------------------------------------------------');
        print_r(PHP_EOL);
    }
}
