<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth'])->group(function () {

    Route::get('/logout', [AuthController::class, 'logout']);
    Route::prefix('admin')->middleware(Admin::class)->group(function () {
        Route::get('/admins', [AdminController::class, 'index']);
        Route::get('/admins/create', [AdminController::class, 'create']);
        Route::post('/admins/store', [AdminController::class, 'store']);
        Route::get('/admins/edit', [AdminController::class, 'edit']);
        Route::post('/admins/update', [AdminController::class, 'update']);

        Route::get('/companies', [CompanyController::class, 'index']);
        Route::get('/companies/create', [CompanyController::class, 'create']);
        Route::post('/companies/store', [CompanyController::class, 'store']);
        Route::get('/companies/edit/{id}', [CompanyController::class, 'edit']);
        Route::post('/companies/update', [CompanyController::class, 'update']);
        Route::get('/companies/delete/{id}', [CompanyController::class, 'delete']);

        Route::get('/employees', [AdminController::class, 'indexEmployees']);

        Route::get('/activty_log', [ActivityController::class, 'index']);


        Route::get('/invitations', [InvitationController::class, 'index']);
        Route::post('/invitations', [InvitationController::class, 'store']);
        Route::get('/invitations/cancel/{id}', [InvitationController::class, 'cancel']);

    });

    Route::get('/dashboard', [EmployeeController::class, 'index']);
    Route::post('/employee/update' , [EmployeeController::class , 'update']);
    Route::get('/company', [EmployeeController::class, 'company']);
});

Route::post('/employee/validate', [EmployeeController::class, 'validateProfile']);
Route::get('invitation/confirm/{token}', [InvitationController::class, 'confirm']);
Route::get('/NotAuthorized', function(){
    return inertia::render('NotAuthorized' , []);
});
