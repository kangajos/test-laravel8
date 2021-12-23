<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\TestBeginerController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
# route test beginer
Route::get("/duplikat", [TestBeginerController::class, "duplikat"])->name("beginer.duplikat");
Route::get("/tangga", [TestBeginerController::class, "tangga"])->name("beginer.tangga");

# handle authenticate
Route::prefix("/auth")->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login.index');
    Route::post('/', [AuthController::class, 'login'])->name('login.post');
    Route::get('registration', [AuthController::class, 'registration'])->name('register.index');
    Route::post('registration', [AuthController::class, 'registrationPost'])->name('register.post');
    Route::get('signout', [AuthController::class, 'signOut'])->name('signout');
});


Route::prefix("/")->middleware("admin")->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix("mutation")->group(function () {
        Route::get('/', [MutationController::class, 'index'])->name('mutation.index');
    });

    Route::prefix("withdraw")->group(function () {
        Route::get('/', [WithdrawController::class, 'index'])->name('withdraw.index');
        Route::get('/create', [WithdrawController::class, 'create'])->name('withdraw.create');
        Route::post('/', [WithdrawController::class, 'store'])->name('withdraw.store');
    });

    Route::prefix("toptup")->group(function () {
        Route::get('/', [TopUpController::class, 'index'])->name('topup.index');
        Route::get('/create', [TopUpController::class, 'create'])->name('topup.create');
        Route::post('/create', [TopUpController::class, 'store'])->name('topup.store');
    });
});
