<?php

namespace App\Http\Controllers;

use App\Models\Suti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SutiController extends Controller
{
    public function index()
    {
        $sutik = Suti::orderBy('nev')->get();

        return view('sutik.index', compact('sutik'));
    }

    public function create()
    {
        return view('sutik.create');
    }

    public function store(Request $request)
    {
        $adatok = $request->validate([
            'nev' => ['required', 'string', 'max:255'],
            'tipus' => ['required', 'string', 'max:255'],
            'dijazott' => ['required', 'boolean'],
        ]);

        Suti::create($adatok);

        return redirect()
            ->route('sutik.index')
            ->with('siker', 'A süteményt sikeresen felvetted.');
    }

    public function edit(Suti $suti)
    {
        return view('sutik.edit', compact('suti'));
    }

    public function update(Request $request, Suti $suti)
    {
        $adatok = $request->validate([
            'nev' => ['required', 'string', 'max:255'],
            'tipus' => ['required', 'string', 'max:255'],
            'dijazott' => ['required', 'boolean'],
        ]);

        $suti->update($adatok);

        return redirect()
            ->route('sutik.index')
            ->with('siker', 'A süteményt sikeresen módosítottad.');
    }

    public function destroy(Suti $suti)
    {
        DB::transaction(function () use ($suti) {
            $suti->arak()->delete();
            $suti->tartalmak()->delete();
            $suti->delete();
        });

        return redirect()
            ->route('sutik.index')
            ->with('siker', 'A süteményt sikeresen törölted.');
    }
}