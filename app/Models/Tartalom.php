<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tartalom extends Model
{
    protected $table = 'tartalom';

    public $timestamps = false;

    public function suti()
    {
        return $this->belongsTo(Suti::class, 'sutiid');
    }
}