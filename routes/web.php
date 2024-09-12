<?php

use App\Http\Controllers\Pages\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Pages\Admin\Login\LoginController as AdminLoginController;
use App\Http\Controllers\Pages\Admin\Logs\LogsController;
use App\Http\Controllers\Pages\Admin\Manage\CashierController;
use App\Http\Controllers\Pages\Admin\Manage\ItemController;
use App\Http\Controllers\Pages\Admin\TransactionHistory\TransactionHistoryController;
use App\Http\Controllers\Pages\Cashier\Login\LoginController as CashierLoginController;
use App\Http\Controllers\Pages\Cashier\Transaction\TransactionController;
use App\Http\Controllers\Pages\IndexController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::prefix('login')->group(function () {
    Route::get('/', [CashierLoginController::class,'index'])->name('login.index');
    Route::post('/', [CashierLoginController::class,'clientLoginAction'])->name('login.action');
});

Route::post('/logout', [CashierLoginController::class,'logout'])->name('logout');

Route::prefix('transaction')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('cashier.transaction.index');
    Route::post('/store', [TransactionController::class, 'store'])->name('cashier.transaction.store');
    Route::post('/transaction', [TransactionController::class, 'transaction'])->name('cashier.transaction.action');
    Route::delete('/delete/{id}', [TransactionController::class, 'destroy'])->name('cashier.transaction.delete');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminIndexController::class,'index'])->name('admin.index');
    Route::get('/logs', [LogsController::class, 'index'])->name('admin.log');
    Route::get('/transaction-history', [TransactionHistoryController::class, 'index'])->name('admin.transaction_history');

    Route::post('/logout', [AdminLoginController::class,'logout'])->name('admin.logout');

    Route::prefix('login')->group(function () {
        Route::get('/', [AdminLoginController::class,'index'])->name('admin.login.index');
        Route::post('/', [AdminLoginController::class,'login'])->name('admin.login.action');
    });

    Route::prefix('manage/cashier')->group(function () {
        Route::get('/', [CashierController::class, 'index'])->name('admin.cashier.index');
        Route::post('/store', [CashierController::class, 'store'])->name('admin.cashier.store');
        Route::put('/update/{id}', [CashierController::class,'update'])->name('admin.cashier.update');
        Route::delete('/delete/{id}', [CashierController::class, 'destroy'])->name('admin.cashier.delete');
    });

    Route::prefix('manage/item')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('admin.item.index');
        Route::post('/store', [ItemController::class, 'store'])->name('admin.item.store');
        Route::put('/update/{id}', [ItemController::class, 'update'])->name('admin.item.update');
        Route::delete('/delete/{id}', [ItemController::class, 'destroy'])->name('admin.item.delete');
    });
});



