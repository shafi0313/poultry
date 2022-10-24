<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Admin\FarmController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SubFarmController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Auth\Role\RoleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DailyEntryController;
use App\Http\Controllers\Admin\EmployeeCatController;
use App\Http\Controllers\Admin\VisitorInfoController;
use App\Http\Controllers\Auth\Permission\PermissionController;
use App\Http\Controllers\Admin\Report\DailyEntryReportController;

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::controller(VisitorInfoController::class)->prefix('visitor-info')->name('visitorInfo.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/delete-selected', 'destroySelected')->name('destroySelected');
    Route::get('/delete-all', 'destroyAll')->name('destroyAll');
});


// !APP BACKUP
Route::controller(BackupController::class)->prefix('app-backup')->name('backup.')->group(function () {
    Route::get('/password', 'password')->name('password');
    Route::post('/checkPassword', 'checkPassword')->name('checkPassword');
    Route::get('/confirm', 'index')->name('index');
    Route::post('/backup-file', 'backupFiles')->name('files');
    Route::post('/backup-db', 'backupDb')->name('db');
    // Route::get('/restore','restoreLoad'])->name('restore');
    // Route::post('/restore/post','restore'])->name('restore.post');
    Route::post('/download/{name}/{ext}', 'downloadBackup')->name('download');
    Route::post('/delete/{name}/{ext}', 'deleteBackup')->name('delete');
});

// Global Ajax Route
Route::delete('/delete-all/{model}', [AjaxController::class, 'deleteAll'])->name('delete_all');
Route::delete('/force-delete-all/{model}', [AjaxController::class, 'forceDeleteAll'])->name('force_delete_all');
Route::get('/select-2-ajax/{model}', [AjaxController::class, 'select2'])->name('select2');

Route::post('/role/permission/{role}', [RoleController::class, 'assignPermission'])->name('role.permission');
Route::resource('/role', RoleController::class);
Route::resource('/permission', PermissionController::class);

// Route::controller(UserController::class)->prefix('user')->name('user.')->group(function () {
//     Route::get('/', 'index')->name('index');
//     Route::get('/create', 'create')->name('create');
//     Route::post('/store', 'store')->name('store');
//     Route::get('/edit/{id}', 'edit')->name('edit');
//     Route::post('/update', 'update')->name('update');
//     Route::any('/destroy/{id}', 'destroy')->name('destroy');
// });

Route::controller(ProfileController::class)->prefix('my-profile')->group(function () {
    Route::get('/', 'index')->name('myProfile.profile.index');
    Route::post('/update', 'update')->name('myProfile.profile.update');
});


Route::resource('/user', UserController::class)->except(['show','create']);
Route::resource('/employee-cat', EmployeeCatController::class)->except(['show','create']);
Route::resource('/employee', EmployeeController::class)->except(['show','create']);
Route::resource('/farm', FarmController::class)->except(['create']);
Route::resource('/sub-farm', SubFarmController::class)->except(['show','create']);
Route::resource('/supplier', SupplierController::class)->except(['show','create']);
Route::resource('/purchase', PurchaseController::class)->except(['show']);
Route::get('/get-farm', [PurchaseController::class, 'getFarm'])->name('purchase.getFarm');
Route::resource('daily-entry', DailyEntryController::class)->except(['show']);
Route::get('daily-entry/get-farm', [DailyEntryController::class, 'getFarm'])->name('dailyEntry.getFarm');

Route::prefix('/report')->group(function(){
    Route::controller(DailyEntryReportController::class)->prefix('/daily-entry')->group(function(){
        Route::get('/select','select')->name('report.dailyEntry.select');
        Route::get('/report','report')->name('report.dailyEntry.report');
    });

});
