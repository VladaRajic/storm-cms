<?php

use App\Livewire\Categories;
use App\Livewire\CreateProduct;
use App\Livewire\CreateUser;
use App\Livewire\ListProduct;
use App\Livewire\ListUsers;
use App\Livewire\UpdateProduct;
use App\Livewire\UpdateUser;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('categories', Categories::class)
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('categories');
Route::get('users/create', CreateUser::class)
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('create-user');
Route::get('users/{user}/update', UpdateUser::class)
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('update-user');
Route::get('users', ListUsers::class)
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('list-user',);
Route::get('products', ListProduct::class)
    ->middleware(['auth', 'verified'])
    ->name('list-product');
Route::get('products/create', CreateProduct::class)
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('create-product');
Route::get('products/{product}/update', UpdateProduct::class)
    ->middleware(['auth', 'verified', 'role:admin|moderator'])
    ->name('update-product');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
