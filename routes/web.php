<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponAssignController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PackagePricingController;
use App\Http\Controllers\RegisterController;
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
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store'])->name('login-store');
Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class,'store'])->name('register-store');
Route::get('/forgot-password', [ForgotPasswordController::class,'index'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class,'store'])->name('forgot-password-store');

Route::middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/card', CardController::class);
    Route::get('/employee-list', [EmployeeController::class,'index'])->name('employee.index');
    Route::get('/employee-create', [EmployeeController::class,'create'])->name('employee.create');
    Route::post('/employee-store', [EmployeeController::class,'store'])->name('employee.store');
    Route::get('/employee/{id}', [EmployeeController::class,'edit'])->name('employee.edit');
    Route::put('/employee-update/{id}', [EmployeeController::class,'update'])->name('employee.update');
    Route::delete('/employee-delete/{id}', [EmployeeController::class,'destroy'])->name('employee.delete');
    //  Upload employee excel file
    Route::get('/employee-upload-create', [EmployeeController::class,'uploadCreate'])->name('employee.upload.create');
    Route::post('/employee-upload', [EmployeeController::class,'upload'])->name('employee.upload');

    Route::resource('/customer', CustomerController::class);
    Route::resource('/package-pricing', PackagePricingController::class);
    Route::resource('/coupon', CouponController::class);
    Route::resource('/category', CategoryController::class);

    //  Upload participant excel file
    Route::get('/export-excel-file', [CouponAssignController::class,'exportExcelFile'])->name('export-excel-file');
    Route::get('/participant-upload-create', [CouponAssignController::class,'participantUploadCreate'])->name('participant.upload.create');
    Route::post('/participant-upload', [CouponAssignController::class,'participantUpload'])->name('participant.upload');

    Route::get('/export-participants-download', [CouponAssignController::class,'exportParticipantsDownload'])->name('export-participants-download');
    Route::get('/export-scanner-download', [CouponAssignController::class,'exportScannerDownload'])->name('export-scanner-download');

    Route::get('/coupon-assign-list', [CouponAssignController::class,'index'])->name('coupon-assign.index');
    Route::get('/coupon-assign-create', [CouponAssignController::class,'create'])->name('coupon-assign.create');
    Route::post('/coupon-assign-store', [CouponAssignController::class,'store'])->name('coupon-assign.store');
    Route::get('/coupon-assign-edit/{id}', [CouponAssignController::class,'edit'])->name('coupon-assign.edit');
    Route::put('/coupon-assign-update/{id}', [CouponAssignController::class,'update'])->name('coupon-assign.update');
    Route::post('/coupon-assign.destroy', [CouponAssignController::class,'destroy'])->name('coupon-assign.destroy');
    Route::post('/scanner.destroy', [CouponAssignController::class,'scannerDestroy'])->name('scanner.destroy');

    Route::get('/scanner-create', [CouponAssignController::class,'scannerCreate'])->name('scanner-create');
    Route::post('/scanner-store', [CouponAssignController::class,'scannerStore'])->name('scanner-store');
    Route::get('/scanner-edit/{id}', [CouponAssignController::class,'scannerEdit'])->name('scanner-edit');
    Route::put('/scanner-update/{id}', [CouponAssignController::class,'scannerUpdate'])->name('scanner-update');

    Route::get('/logout', [LoginController::class,'destroy'])->name('logout');
});

