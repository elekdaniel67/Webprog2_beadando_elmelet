<?php

namespace App\Http\Controllers;

use App\Services\KedvezmenyKalkulator;
use Illuminate\Http\Request;

class KalkulatorController extends Controller
{
    public function index()
    {
        return view('kalkulator');
    }

    public function szamol(Request $request, KedvezmenyKalkulator $kalkulator)
    {
        $adatok = $request->validate([
            'ar' => ['required', 'numeric', 'min:0'],
            'kedvezmeny' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $eredmeny = $kalkulator->szamol(
            (float) $adatok['ar'],
            (float) $adatok['kedvezmeny']
        );

        return view('kalkulator', compact('eredmeny', 'adatok'));
    }
}