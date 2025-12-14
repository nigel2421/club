<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DemographicsController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('members', MemberController::class);

Route::get('/demographics', [DemographicsController::class, 'index'])->name('demographics');
