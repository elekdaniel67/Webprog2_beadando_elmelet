<?php

use App\Http\Controllers\KalkulatorController;
use App\Http\Controllers\SutiController;
use App\Models\Suti;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UzenetController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/adatbazis', function () {
    $sutik = Suti::with(['arak', 'tartalmak'])->get();

    return view('adatbazis', compact('sutik'));
})->name('adatbazis');

Route::get('/kapcsolat', function () {
    return view('kapcsolat');
})->name('kapcsolat');

Route::post('/kapcsolat', [UzenetController::class, 'kuldes'])
    ->name('kapcsolat.kuldes');
Route::get('/diagram', function () {
    $adatok = Suti::selectRaw('tipus, COUNT(*) as darab')
        ->groupBy('tipus')
        ->orderBy('tipus')
        ->get();

    return view('diagram', compact('adatok'));
})->name('diagram');
Route::get('/teszt', [KalkulatorController::class, 'index'])
    ->name('teszt');

Route::post('/teszt', [KalkulatorController::class, 'szamol'])
    ->name('teszt.szamol');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('user', function () {
        return view('user');
    })->name('user');

    Route::get('admin', [AdminController::class, 'adminPage'])
        ->name('admin');

    Route::get('workers', [AdminController::class, 'adminPage'])
        ->name('workers.index');

    Route::get('/uzenetek', [UzenetController::class, 'lista'])
        ->name('uzenetek');
    Route::resource('sutik', SutiController::class)
    ->parameters(['sutik' => 'suti'])
    ->except(['show'])
    ->middleware('can:manage-sutik');
});

Route::get('exercise1', function () {
    return view('view1');
});

Route::get('introduction', function () {
    return view('introduction');
})->name('introduction');

require __DIR__.'/auth.php';