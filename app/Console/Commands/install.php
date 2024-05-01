<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para criar as coisas iniciais';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->write('Atualização do Composer');
        shell_exec('composer update');


        $this->write('Rodando as Migrations');
        $this->call('migrate');

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
