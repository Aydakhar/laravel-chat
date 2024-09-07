<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/', function() {
        $users = User::whereNot('id', auth()->id())->get();
        return view('dashboard', ['users' => $users]);
    })->name('dashboard');

    Route::get('chat/{user?}', function(?User $user = null) {
        return view('chat', ['user' => $user]);
    })->whereNumber('user')->name('chat');
});

Route::redirect('/home', '/');

require __DIR__.'/auth.php';
