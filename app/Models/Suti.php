<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suti extends Model
{
    protected $table = 'suti';

    public $timestamps = false;

    public function arak()
    {
        return $this->hasMany(Ar::class, 'sutiid');
    }

    public function tartalmak()
    {
        return $this->hasMany(Tartalom::class, 'sutiid');
    }
}