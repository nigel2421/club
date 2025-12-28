<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\DemographicsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/overview', [OverviewController::class, 'index'])->name('overview');

Route::get('/members/upload', [MemberController::class, 'showUploadForm'])->name('members.showUploadForm');
Route::post('/members/upload', [MemberController::class, 'upload'])->name('members.upload');
Route::get('members/download-sample', [MemberController::class, 'downloadSample'])->name('members.downloadSample');
Route::delete('/members/mass-delete', [MemberController::class, 'massDestroy'])->name('members.massDestroy');
Route::get('/members/export', [MemberController::class, 'export'])->name('members.export');
Route::get('/members/{member}/details', [MemberController::class, 'details'])->name('members.details');

Route::resource('members', MemberController::class);

Route::get('/demographics', [DemographicsController::class, 'index'])->name('demographics');