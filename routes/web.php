<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', function () {
    return view('signin');
});

Route::get('/signin', [AuthController::class, 'signin_form'])->name('signin');


//Login & Signup
Route::get('/signin', [AuthController::class, 'signin_form'])->name('signin');

Route::post('/signup', [AuthController::class, 'signupPost'])->name('signup.post');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');


Route::middleware(['user'])->group(function () {
    // Your protected routes go here
    Route::get('/userdashboard', [UserController::class, 'dashboard'])->name('userdashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/addaccount', [UserController::class, 'addaccount'])->name('addaccount');
    Route::post('/createaccount', [AccountController::class, 'createAccount'])->name('createaccount');
    Route::get('/getaccounts', [AccountController::class, 'getAccounts'])->name('getaccounts');
    Route::get('/account/{account_number}', [AccountController::class, 'account'])->name('account');
    Route::get('/{account_number}/transfer', [AccountController::class, 'transfer'])->name('transfer');
    Route::post('/transfer/{account_number}', [AccountController::class, 'transferPost'])->name('transfer.postt');
    Route::get('/transactions',[TransactionController::class,'transactionsGet'])->name('transactions.get');
    Route::get('/{account_number}/transactions',[TransactionController::class,'transactionsGetAccount'])->name('transactions.getaccount');
    Route::get('/{account_number}/transfer/transferfailure',[AccountController::class,'transferfailure'])->name('transferfailure');
    Route::get('/{account_number}/transfer/transfersuccess',[AccountController::class,'transfersuccess'])->name('transfersuccess');
    Route::get('/createaccount/success',[AccountController::class,'accountsuccess'])->name('accountsuccess');
});


