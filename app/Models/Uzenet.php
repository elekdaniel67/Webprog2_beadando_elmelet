<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uzenet extends Model
{
    protected $table = 'uzenets';

    protected $fillable = [
        'nev',
        'email',
        'uzenet',
    ];
}