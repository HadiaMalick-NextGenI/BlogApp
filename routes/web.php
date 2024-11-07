<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthorizationMiddleware;
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

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

//Route::get('/', [SessionController::class , 'index']);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/store-session', [SessionController::class , 'storeSession']);

Route::get('/delete-session', [SessionController::class , 'deleteSession']);

Route::get('/show-view', [CookiesController::class, 'showView'])->name('show-view');
Route::post('/set-cookie', [CookiesController::class, 'setCookie'])->name('set-cookie');
Route::get('/get-cookie', [CookiesController::class , 'getCookie']);
Route::get('/delete-cookie', [CookiesController::class , 'deleteCookie']);

Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'handleLogin']);

Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/register', [SignupController::class, 'register'])->name('register');

Route::middleware(AuthMiddleware::class)->group(function() {

    Route::get('/home', 
    [LoginController::class, 'showHome'])->name('home');

    Route::resource('blogs', BlogController::class)
        ->missing(function () {
            return redirect()->route('blogs.index')->with('error', 'Blog not found.');
        });

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/contact', [ContactController ::class, 'show'])->name('contact.show');
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

    Route::get('/notifications', [NotificationController::class, 'showNotifications'])->name('notifications.index');
    Route::patch('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

    Route::middleware(AuthorizationMiddleware::class)->group(function() {
        Route::resource('users', UserController::class);
    });
});

Route::get('/collection', [CollectionController::class, 'test']);

Route::get('/logout', [HomeController::class, 'logout'])->name('logout');