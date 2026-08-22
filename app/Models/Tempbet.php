<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempbet extends Model
{
    protected $fillable = [
    'session','user',
    'zero','one','two','three','four','five',
    'six','seven','eight','nine','ten','eleven'
];
}
