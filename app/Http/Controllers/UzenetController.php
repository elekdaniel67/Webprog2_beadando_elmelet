<?php

namespace App\Http\Controllers;

use App\Models\Uzenet;
use Illuminate\Http\Request;

class UzenetController extends Controller
{
    public function kuldes(Request $request)
    {
        $adatok = $request->validate([
            'nev' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'uzenet' => ['required', 'string', 'max:5000'],
        ]);

        Uzenet::create($adatok);

        return redirect()
            ->route('kapcsolat')
            ->with('siker', 'Az üzenetet sikeresen elküldted!');
    }

    public function lista()
    {
        $uzenetek = Uzenet::orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        return view('uzenetek', compact('uzenetek'));
    }
}