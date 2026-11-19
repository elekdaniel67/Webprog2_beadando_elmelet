<?php

namespace App\Services;

class KedvezmenyKalkulator
{
    public function szamol(float $ar, float $kedvezmeny): float
    {
        return round($ar * (1 - $kedvezmeny / 100), 2);
    }
}