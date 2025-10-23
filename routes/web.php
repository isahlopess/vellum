<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Acervo;
use App\Livewire\ClubeLivro;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', Dashboard::class)
    ->name('dashboard');

Route::get('/clube-do-livro', ClubeLivro::class)
    ->name('clube-do-livro');

Route::get('/acervo', Acervo::class)
    ->name('acervo');

