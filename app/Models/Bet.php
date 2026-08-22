<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $fillable = [
    'sessionId',
    'amount',
    'disbursed',
    'percent',
    'number',
    'times',
    'status',
    'carry'
];
}
