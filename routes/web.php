<?php

use App\Livewire\ShowQuotesPage;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('quotes', ShowQuotesPage::class)
    ->middleware(['auth', 'verified'])
    ->name('quotes');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
