<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    use HasFactory;

    protected $fillable = [
        'Cur_ID',
        'Date',
        'Cur_Abbreviation',
        'Cur_Scale',
        'Cur_Name',
        'Cur_OfficialRate'
    ];
}
