<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AcController;
use App\Http\Controllers\AcN2Controller;
use App\Http\Controllers\ArController;
use App\Http\Controllers\JsonImportController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


Route::middleware('auth')->group(function () {
    Route::get('/', function () {return view('home');})->name('home');

    Route::resource('ac', AcController::class);
    Route::get('generate-qrcode/ac/{id}', [AcController::class, 'generateQRCode'])->name('ac.qrcode');

    Route::resource('ac_n2', AcN2Controller::class);
    Route::get('generate-qrcode/ac_n2/{id}', [AcN2Controller::class, 'generateQRCode'])->name('ac_n2.qrcode');

    Route::resource('ar', ArController::class);
    Route::get('generate-qrcode/ar/{id}', [ArController::class, 'generateQRCode'])->name('ar.qrcode');

    Route::get('import-json', [JsonImportController::class, 'index'])->name('json.import');
    Route::post('import-json', [JsonImportController::class, 'store'])->name('json.store');

});