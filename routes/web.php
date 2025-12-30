<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

#Pegawai Controllers
use App\Http\Controllers\Pegawai\DashboardController;
use App\Http\Controllers\Pegawai\AsetController;

#Admin Controllers
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ManajemenAsetController;
use App\Http\Controllers\Admin\KategoriAsetController;
use App\Http\Controllers\Admin\KondisiAsetController;


Route::get('/', function () {
    return to_route('login');
});

#Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

#Pegawai Routes
Route::middleware(['auth'])->prefix('pegawai')->name('pegawai.')->group(function () {

    // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Aset Baru
        Route::get('/aset-baru', [AsetController::class, 'new'])
            ->name('aset.new');

        // Aset Terpakai
        Route::get('/aset-terpakai', [AsetController::class, 'used'])
            ->name('aset.used');

});


#Admin Routes
// Route::middleware(['auth', 'role:admin'])
//     ->prefix('admin')
//     ->group(function () {

    // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

    //Manajemen User
        Route::get('/manajemen-user', [UserController::class, 'index'])->name('users.index');
        Route::get('/manajemen-user/input', [UserController::class, 'create'])->name('users.create');
        Route::post('/manajemen-user', [UserController::class, 'store'])->name('users.store');
        Route::put('/manajemen-user/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/manajemen-user/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    //Manajemen Aset
        Route::get('/manajemen-aset', [ManajemenAsetController::class, 'index'])
            ->name('manajemen-aset.index');
        route::get('/manajemen-aset/aset-baru', [ManajemenAsetController::class, 'asetBaru'])
            ->name('manajemen-aset.aset-baru');
        
        Route::get('/manajemen-aset/input', [ManajemenAsetController::class, 'create'])
            ->name('manajemen-aset.create');
        Route::post('/manajemen-aset', [ManajemenAsetController::class, 'store'])
            ->name('manajemen-aset.store');
        route::get('/manajemen-aset/{aset}/edit', [ManajemenAsetController::class, 'edit'])
            ->name('manajemen-aset.edit');
        route::put('/manajemen-aset/{aset}', [ManajemenAsetController::class, 'update'])
            ->name('manajemen-aset.update');
        route::delete('/manajemen-aset/{aset}', [ManajemenAsetController::class, 'destroy'])
            ->name('manajemen-aset.destroy');

        #Kategori Aset
        Route::get('/kategori-aset', [KategoriAsetController::class, 'index'])->name('kategori-aset.index');
        Route::post('/kategori-aset/store', [KategoriAsetController::class, 'store'])->name('kategori-aset.store');
        Route::delete('/kategori-aset/{id}', [KategoriAsetController::class, 'destroy'])->name('kategori-aset.destroy');

        #Kondisi Aset
        Route::get('/kondisi-aset', [KondisiAsetController::class, 'index'])->name('kondisi-aset.index');
        Route::post('/kondisi-aset', [KondisiAsetController::class, 'store'])->name('kondisi-aset.store');
        Route::delete('/kondisi-aset/{id}', [KondisiAsetController::class, 'destroy'])->name('kondisi-aset.destroy');
    // });
