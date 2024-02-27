<?php

use App\Http\Controllers\{DashboardController, CompaniesController, EmployeesController};
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

Route::get('/', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('companies', CompaniesController::class)->except(['show']);
    Route::resource('employees', EmployeesController::class)->except(['show']);
});

require __DIR__.'/auth.php';

Auth::routes();
