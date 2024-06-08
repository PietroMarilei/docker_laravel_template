<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //🖼️ profile pic updater
    Route::post('/profile', [ProfileController::class, 'updateProfileImage'])->name('profile.photo');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //mostra tutti gli user
    Route::get('/users', [ProfileController::class, 'index'])->name('users.index');
    // Route::resource('messages', MessageController::class);
    // Route::get('/chat/getMessages', [MessageController::class, 'index'])->name('messages.index');
    //rotta che invia il messaggio
    Route::post('/chat/sendNewMessage', [MessageController::class, 'sendNewMessage'])->name('messages.send');
    //singleChat route
    Route::get('/chat/{receiverId}', [MessageController::class, 'index'])->name('chat.index');

    
});


require __DIR__.'/auth.php';
