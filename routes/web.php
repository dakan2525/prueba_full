<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/', [AdministratorController::class, "login"])->name("login");
Route::post('/check', [AdministratorController::class, "check"])->name("check");


Route::middleware(["auth:web"])->group(function () {
    // Dashboard
    Route::get("/dashboard", [AdministratorController::class, "dashboard"])->name("dashboard");
    Route::resource('/users', UserController::class)->names("users");
    Route::get("/change-status/{user}", [UserController::class, "changeStatus"])->name("change-status");
    Route::post("/logout", [AdministratorController::class, "logout"])->name("logout");
});
