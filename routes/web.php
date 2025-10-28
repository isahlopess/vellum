<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Acervo;
use App\Livewire\ClubeLivro;

Route::get('/', function () {
    return redirect('/login');
});
Route::post('logout', Logout::class)->name('logout');


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', Dashboard::class)
        ->name('dashboard');

    Route::get('/clube-do-livro', ClubeLivro::class)
        ->name('clube-do-livro');

    Route::get('/acervo', Acervo::class)
        ->name('acervo');


    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');
});

require __DIR__.'/auth.php';
