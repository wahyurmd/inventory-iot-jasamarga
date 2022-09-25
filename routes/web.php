<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BorrowController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // INVENTORY PROCESS
    Route::get('/inventory', [InventarisController::class, 'index'])->name('inventory');
    Route::post('/inventory', [InventarisController::class, 'addInventory']);
    Route::post('/inventory/edit/{id}', [InventarisController::class, 'editInventory']);
    Route::post('/inventory/delete/{id}', [InventarisController::class, 'delInventory']);
    Route::post('/inventory/transfer/{id}', [InventarisController::class, 'transferInventory']);
    
    // ROOM PROCESS
    Route::get('/room', [RoomController::class, 'index'])->name('room');
    Route::post('/room', [RoomController::class, 'addRoom']);
    Route::post('/room/edit/{id}', [RoomController::class, 'editRoom']);
    Route::post('/room/delete/{id}', [RoomController::class, 'delRoom']);
    
    // PEMINJAMAN PROCESS
    Route::get('/borrowing', [BorrowController::class, 'index'])->name('borrowing');
    Route::post('/borrowing', [BorrowController::class, 'addBorrowing']);
    Route::post('/borrowing/restore/{id}', [BorrowController::class, 'restoreBorrowing']);
});

Route::get('/dash', function () {
    return view('dash');
});