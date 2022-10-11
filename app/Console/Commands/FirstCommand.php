<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FirstCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:nbrb {currency?} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $this->argument('currency');
//        $this->argument();
        if(!$this->argument('currency')){
            $this->confirm('Вопрос ???');
            $this->info('Yeap!');
    }
        return 0;
    }
}
