<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'handleLogin']);

Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/register', [SignupController::class, 'register'])->name('register');

Route::middleware(AuthMiddleware::class)->group(function() {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', 
    [LoginController::class, 'showHome'])->name('home');

    Route::resource('blogs', BlogController::class)
        ->missing(function () {
            return redirect()->route('blogs.index')->with('error', 'Blog not found.');
        });

    Route::middleware(AdminMiddleware::class)->group(function() {
        Route::resource('users', UserController::class);
    });
});

Route::get('/logout', [HomeController::class, 'logout'])->name('logout');