<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\MergeOrder;
use App\Http\Livewire\ShowOrder;
use App\Http\Livewire\ShowOrders;
use App\Http\Livewire\ShowTable;
use App\Http\Livewire\ShowTables;
use App\Http\Livewire\SplitOrder;
use App\Http\Livewire\Tables;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');
});

Debugbar::disable();
Route::middleware('auth')->group(function () {

    Route::get('/', ShowTables::class)->name('home');
    Route::get('/orders', ShowOrders::class)->name('orders');
    Route::get('/orders/{order}/merge', MergeOrder::class)->name('merge');
    Route::get('/orders/{order}/split', SplitOrder::class)->name('split');
    Route::get('/orders/{order}/checkout', Checkout::class)->name('checkout');
    Route::get('/orders/{order}/{table?}', ShowOrder::class)->name('order');


    Route::get('/{table}/orders', ShowTable::class)->name('table');



    Route::post('logout', LogoutController::class)
        ->name('logout');
});
