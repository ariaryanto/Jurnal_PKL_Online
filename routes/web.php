<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

//  jika user belum login
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'dologin'])->name('dologin');
    Route::get('/', [AuthController::class, 'welcome']);
});

// untuk admin dan user
Route::group(['middleware' => ['auth', 'checkrole:1,2']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/redirect', [RedirectController::class, 'cek']);
});


// untuk admin
Route::group(['middleware' => ['auth', 'checkrole:1']], function () {
    Route::get('/admin/beranda', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/tambah-user', [AdminController::class, 'create']);
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::get('/admin/{id}/sedit', [AdminController::class, 'sedit'])->name('admin.sedit');
    Route::get('/admin/{id}/show', [AdminController::class, 'show'])->name('admin.show');
    Route::put('/admin/{id}/update', [AdminController::class, 'update'])->name('admin.update');
    Route::put('/admin/{id}/supdate', [AdminController::class, 'supdate'])->name('admin.supdate');
    Route::post('/admin/tambah-user', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('/admin/{id}/delete', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::delete('/admin/{id}/sdelete', [AdminController::class, 'sdestroy'])->name('admin.sdelete');
    Route::get('/admin/{id}/print', [AdminController::class, 'pdf'])->name('admin.pdf');
});

// untuk user
Route::group(['middleware' => ['auth', 'checkrole:2']], function () {
    Route::get('/user/beranda', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/kegiatan', [UserController::class, 'create']);
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('/user/print', [UserController::class, 'pdf'])->name('user.pdf');
});
