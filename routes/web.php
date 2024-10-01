<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified','rolemanager:admin'])->name('admin');

Route::get('/merchant/dashboard', function () {
    return view('merchant.dashboard');
})->middleware(['auth', 'verified','rolemanager:merchant'])->name('merchant');

Route::get('/customer/dashboard', function () {
    return view('customer.dashboard');
})->middleware(['auth', 'verified','rolemanager:customer'])->name('customer');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/merchant/menus', [MenuController::class, 'index'])->name('merchant.menus');
    Route::get('/merchant/menus/add', [MenuController::class, 'add'])->name('merchant.menus.add');
    Route::post('/merchant/menus/save', [MenuController::class, 'save'])->name('merchant.menus.save');
    Route::get('/merchant/menus/edit/{id}', [MenuController::class, 'edit'])->name('merchant.menus.edit');
    Route::put('/merchant/menus/edit/{id}', [MenuController::class, 'update'])->name('merchant.menus.update');
    Route::get('/merchant/menus/delete/{id}', [MenuController::class, 'delete'])->name('merchant.menus.delete');
});

require __DIR__.'/auth.php';
