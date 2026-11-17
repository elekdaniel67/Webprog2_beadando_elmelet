<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminController;

Route::get('/', function () { 
    return view('welcome'); 
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () { 
        return view('dashboard'); 
    })->name('dashboard');
    
    Route::get('user', function () { 
        return view('user'); 
    })->name("user");
    
    Route::get('admin', [AdminController::class, 'adminPage'])->name('admin');
    Route::get('workers', [AdminController::class, 'adminPage'])->name('workers.index');
    
    Route::get('/adatbazis', function () {
        $sutik = DB::table('suti')->get();
        $arak = DB::table('ar')->get()->groupBy('sutiid');
        $tartalmak = DB::table('tartalom')->get()->groupBy('sutiid');
        return view('adatbazis', compact('sutik', 'arak', 'tartalmak'));
    })->name('adatbazis');

    Route::get('/kapcsolat', function () {
        return view('kapcsolat');
    })->name('kapcsolat');

    Route::get('/uzenetek', function () {
        return view('uzenetek');
    })->name('uzenetek');
});

Route::get('exercise1', function () { 
    return view('view1'); 
});

Route::get('introduction', function () { 
    return view('introduction'); 
})->name('introduction');

require __DIR__.'/auth.php';
