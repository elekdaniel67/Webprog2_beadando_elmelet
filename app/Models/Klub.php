<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klub extends Model
{
    protected $table = 'klub';

    public $timestamps = false;

    protected $fillable = [
        'csapatnev',
    ];
}