<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HomeController;

Route::post('/transfer', [TransactionController::class, 'transfer'])->name('transfer')->middleware('auth');
//Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');


Route::post('/transfer', [TransactionController::class, 'transfer'])->name('transfer')->middleware('auth');
Route::get('/', function () {
    return view('welcome');
});



//Route::get('/dashboard', function () {
  //  return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    // Carrega o usuário autenticado com a wallet
    $user = Auth::user()->load('wallet'); 
    
    // Retorna a view passando a variável $user
    return view('dashboard', compact('user'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
