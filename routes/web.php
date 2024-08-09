<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('blogs', BlogController::class);
Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/home', [BlogController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [BlogController::class, 'dashboard'])->name('dashboard');
