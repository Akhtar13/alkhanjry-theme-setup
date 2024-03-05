<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProfileController;
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
    return redirect()->route('admin.login');
});

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login-check', [LoginController::class, 'loginCheck'])->name('login-check');

Route::group(['middleware' => ['auth:admin']], function () {

//    Main Routes
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('my-profile', [ProfileController::class, 'index'])->name('my-profile');
    Route::post('updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::get('change-panel-mode/{id}', [DashboardController::class, 'changePanelMode'])->name('change-panel-mode');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard2', [DashboardController::class, 'index2'])->name('dashboard2');
    Route::get('/change-password', [PasswordController::class, 'index'])->name('change-password');
    Route::post('update-password', [PasswordController::class, 'updatePassword'])->name('update-password');

//    Extra routes

//    Status Change Routes
    Route::get('/event/status/{id}/{status}', [EventController::class, 'changeStatus'])->name('change-status-event');

//    Resource Routes
    Route::resource('event', EventController::class);

//    Datatable Routes
    Route::get('/get-event', [EventController::class, 'getDatatable'])->name('get-event');

});
