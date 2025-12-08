<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    Route::view('/tickets', 'tickets.index')->name('tickets.index');
    Route::view('/tickets/create', 'tickets.create')->name('tickets.create');
    Route::view('/users', 'users.index')->name('users.index');

    Route::get('/tickets/{id}', function ($id) {
        return view('tickets.show', ['ticket' => Ticket::with('user')->findOrFail($id)]);
    })->name('tickets.show');

    Route::get('/users/{id}/edit', function ($id) {
        return view('users.edit',['user' => User::findOrFail($id)]);
    })->name('users.edit');
});
