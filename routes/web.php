<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\StripeController;
use App\Livewire\AddItem;
use App\Livewire\Cart;
use App\Livewire\ItemTable;
use App\Livewire\ItemUpdate;
use App\Livewire\Orders;
use App\Livewire\ShowItem;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/addItem', AddItem::class)->name('addItem')->middleware(['auth', 'can:admin']);

Route::get('/edit/{item}', ItemUpdate::class)->name('edit')->middleware(['auth', 'can:admin']);

Route::get('/item/{item}', ShowItem::class)->name('show');

Route::get('itemTable', ItemTable::class)->name('itemTable')->middleware(['auth', 'can:admin']);

Route::get('/cart', Cart::class)->name('cart')->middleware('auth');

Route::get('/orders', Orders::class)->name('orders')->middleware('auth');

//auth
Route::get('/register',[AuthController::class, 'register'])->name('register');

Route::post('/register',[AuthController::class, 'store']);

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//paypal
Route::post('paypal', [PaypalController::class, 'paypal'])->name('paypal');

Route::get('successPaypal', [PaypalController::class, 'success'])->name('success');

Route::get('cancelPaypal', [PaypalController::class, 'cancel'])->name('cancel');

//stripe
Route::post('stripe', [StripeController::class, 'stripe'])->name('stripe');

Route::get('successStripe', [StripeController::class, 'success'])->name('stripe.success');

Route::get('cancelStripe', [StripeController::class, 'cancel'])->name('stripe.cancel');

