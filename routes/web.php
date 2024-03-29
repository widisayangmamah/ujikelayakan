<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\usergController;
use App\Http\Controllers\LetterTypeController;

Route::get('/', function () { 
    return view('home');
});

Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/create', [userController::class, 'create'])->name('create');
    Route::post('/store', [usercontroller::class, 'store'])->name('store');
    Route::get('/', [usercontroller::class, 'index'])->name('home');
    Route::get('/{id}', [userController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [userController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [userController::class, 'destroy'])->name('delete');
});

Route::prefix('/userg')->name('userg.')->group(function () {
    Route::get('/create', [usergController::class, 'create'])->name('create');
    Route::post('/store', [usergController::class, 'store'])->name('store');
    Route::get('/', [usergController::class, 'index'])->name('home');
    Route::get('/{id}', [usergController::class, 'edit'])->name('edit');
    Route::get('/{id}', [usergController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [usergController::class, 'destroy'])->name('delete');
});

Route::prefix('/lettertype')->name('lettertype.')->group(function() {
    Route::get('/create', [LetterTypeController::class, 'create'])->name('create');
    Route::post('/store', [LetterTypeController::class, 'store'])->name('store');
    Route::get('/', [LetterTypeController::class, 'index'])->name('home');
    Route::get('/{id}', [LetterTypeController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [LetterTypeController::class, 'update'])->name('update');
    Route::delete('/{id}', [LetterTypeController::class, 'destroy'])->name('delete');
});