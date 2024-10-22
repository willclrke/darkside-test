<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerFormController;

// Form route
Route::get('/', function () {
    return view('form');
})->name('form');

// Form submit route
Route::post('/submit', [CustomerFormController::class, 'submit'])->name('customer.submit');