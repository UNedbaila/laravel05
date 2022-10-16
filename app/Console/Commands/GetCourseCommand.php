<?php

namespace App\Console\Commands;

use App\Http\Controllers\CoursesController;
use App\Mail\CourseMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class GetCourseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:course {course?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Request for exchange rates';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $course = $this->argument('course');
        $curs_name = [];
        $value = [];
        $date = [];

        $responce = Http::get('https://www.nbrb.by/api/exrates/rates?periodicity=0');
        $currencies = $responce->json();
        foreach ($currencies as $curs) {
            $curs_name[] = $curs['Cur_Abbreviation'];
            $value[] = $curs['Cur_OfficialRate'];
            $date[] = $curs['Date'];
        }

        if ($course) {

            //$course = $this->ask('Введите код валюты (USD, EUR, PLN)');

            $key = array_search($course, $curs_name);
            if (in_array($course, $curs_name)) {
                $value = $value[$key];
                $date = $date[$key];
            }


        } else {

            $course = $this->ask('Введите код валюты (USD, EUR, PLN)');

            $key = array_search($course, $curs_name);
            if (in_array($course, $curs_name)) {
                $value = $value[$key];
                $date = $date[$key];
            }

        }

        $this->info('Курс НБРБ ' . $value . ' ' . $course . ' ' . $date);

        $mail = new CourseMail('Курс НБРБ ' . $value . ' ' . $course . ' ' . $date);
        Mail::send($mail);

    }
}
