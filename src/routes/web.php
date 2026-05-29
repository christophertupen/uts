<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Livewire asset handling
|--------------------------------------------------------------------------
*/

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});

/*
|--------------------------------------------------------------------------
| Frontend Portfolio Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PortfolioController::class, 'index'])
    ->name('home');

Route::get('/projects/{project:slug}', [PortfolioController::class, 'show'])
    ->name('projects.show');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

/*
|--------------------------------------------------------------------------
| Profile Routes (API)
|--------------------------------------------------------------------------
*/

Route::post('/api/profile/update-photo', [ProfileController::class, 'updatePhoto'])
    ->name('profile.update-photo');

Route::post('/api/profile/update', [ProfileController::class, 'update'])
    ->name('profile.update');