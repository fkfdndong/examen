<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registersave'])->name('register.save');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('login.post');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('profile', [AuthController::class, 'profile'])->name('profile');

    // Modifier le profil utilisateur
    Route::get('profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    // Changer le mot de passe utilisateur
    Route::get('change-password', [AuthController::class, 'changePasswordForm'])->name('change-password.form');
    Route::post('change-password', [AuthController::class, 'changePassword'])->name('change-password');

    

});

