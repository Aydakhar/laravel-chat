<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    $users = User::whereNot('id', auth()->id())->get();
    return view('dashboard', ['users' => $users]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('chat/{user?}', function(?User $user = null) {
    return view('chat', ['user' => $user]);
})->middleware(['auth', 'verified'])->name('chat');

require __DIR__.'/auth.php';
