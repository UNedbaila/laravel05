<?php

namespace App\Http\Controllers;

use App\Models\Rates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SaveRatesController extends Controller
{
    public function saveRates(){

        $responce = Http::get('https://www.nbrb.by/api/exrates/rates?periodicity=0');
        $currencies = $responce->json();

        foreach ($currencies as $value) {

            Rates::query()->create(
                [
                    'Cur_ID' => $value['Cur_ID'],
                    'Date' => $value['Date'],
                    'Cur_Abbreviation' => $value['Cur_Abbreviation'],
                    'Cur_Scale' => $value['Cur_Scale'],
                    'Cur_Name' => $value['Cur_Name'],
                    'Cur_OfficialRate' => $value['Cur_OfficialRate'],
                ]
            );
        }
    }
}
