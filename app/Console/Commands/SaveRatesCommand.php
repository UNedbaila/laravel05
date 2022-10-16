<?php

namespace App\Console\Commands;

use App\Http\Controllers\SaveRatesController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SaveRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Saving exchange rates in the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $saveRates = new SaveRatesController();
        $saveRates->saveRates();

    }
}
