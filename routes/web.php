<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect('/dashboard');
});
Route::get('/home', [HomeController::class, 'index']);
Route::get('/arsip', [HomeController::class, 'arsip'])->name('arsip');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/klasifikasi', function () {
    return view('klasifikasi'); // Pastikan ini sesuai dengan nama layout kamu
});
// routes/web.php (Frontend)

