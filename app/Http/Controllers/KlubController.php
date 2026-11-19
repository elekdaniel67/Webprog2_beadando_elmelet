<?php

namespace App\Http\Controllers;

use App\Models\Klub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KlubController extends Controller
{
    public function index()
    {
        return response()->json(Klub::orderBy('csapatnev')->get());
    }

    public function store(Request $request)
    {
        $adatok = $request->validate([
            'csapatnev' => ['required', 'string', 'max:255'],
        ]);

        $klub = Klub::create($adatok);

        return response()->json($klub, 201);
    }

    public function update(Request $request, Klub $klub)
    {
        $adatok = $request->validate([
            'csapatnev' => ['required', 'string', 'max:255'],
        ]);

        $klub->update($adatok);

        return response()->json($klub);
    }

    public function destroy(Klub $klub)
    {
        $vanJatekos = DB::table('labdarugo')
            ->where('klubid', $klub->id)
            ->exists();

        if ($vanJatekos) {
            return response()->json([
                'message' => 'A klub nem törölhető, mert játékosok tartoznak hozzá.',
            ], 409);
        }

        $klub->delete();

        return response()->noContent();
    }
}