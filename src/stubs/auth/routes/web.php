<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');

Route::layout('layouts.auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::livewire('login', 'auth.login')
            ->name('login');

        Route::livewire('register', 'auth.register')
            ->name('register');
    });

    Route::livewire('password/reset', 'auth.passwords.email')
        ->name('password.request');

    Route::livewire('password/reset/{token}', 'auth.passwords.reset')
        ->name('password.reset');

    Route::middleware('auth')->group(function () {
        Route::livewire('email/verify', 'auth.verify')
            ->middleware('throttle:6,1')
            ->name('verification.notice');

        Route::livewire('password/confirm', 'auth.passwords.confirm')
            ->name('password.confirm');
    });
});

Route::middleware('auth')->group(function () {
    Route::livewire('home', 'home')
        ->name('home');

    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', [LoginController::class, 'logout'])
        ->name('logout');
});
