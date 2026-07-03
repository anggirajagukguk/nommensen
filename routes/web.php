<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingpageController;

Route::get('/', [LandingpageController::class, 'index'])->name('home');
Route::get('/dosen', [LandingpageController::class, 'lectures'])->name('lectures');
Route::get('/profil', [LandingpageController::class, 'profile'])->name('profile');
Route::get('/pengumuman', [LandingpageController::class, 'announcements'])->name('announcements');
Route::get('/berita', [LandingpageController::class, 'news'])->name('news');
Route::get('/mahasiswa', [LandingpageController::class, 'students'])->name('students');
