<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\SuccessController;
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


Route::middleware(['agent'])->group(function () {

    
    // Your protected routes go here
    Route::get('/logoutagent', [AuthController::class, 'logoutagent'])->name('logout.agent');


    Route::get('/agentdashboard', [AgentController::class, 'agentdashboard'])->name('agentdashboard');
    Route::get('/agentdashboard/pendingaccounts', [AgentController::class, 'getPending'])->name('pendings');
    Route::get('/agentdashboard/activeaccounts', [AgentController::class, 'getActive'])->name('actives');

    Route::get('/agentdashboard/pendingaccounts/{id}/accept', [AgentController::class, 'acceptAccount'])->name('acceptAccount');
    Route::get('/agentdashboard/pendingaccounts/{id}/reject', [AgentController::class, 'rejectAccount'])->name('rejectAccount');

    Route::get('/account-not-found', [ErrorController::class, 'accountNotFound'])->name('accountnotfound');
    Route::get('/account-activated', [SuccessController::class, 'accountActivated'])->name('accountactivated');
    Route::get('/account-rejected', [SuccessController::class, 'accountRejected'])->name('accountrejected');

    Route::get('/borubaccount/{id}', [AgentController::class, 'accountBUB'])->name('UorBaccount');
    Route::get('/account-blocked', [SuccessController::class, 'accountBlocked'])->name('accountblocked');
    Route::get('/account-unblocked', [SuccessController::class, 'accountUnblocked'])->name('accountunblocked');

    Route::get('/account-withdraw/{id}', [AgentController::class, 'withdrawDisplay'])->name('withdraw.display');
    Route::post('/account-withdraw/{id}/process', [AgentController::class, 'withdrawPost'])->name('withdraw.post');
    Route::get('/withdrawal-exceeded', [ErrorController::class, 'withdrawExceeded'])->name('withdrawexceeded');
    Route::get('/withdrawal-success', [SuccessController::class, 'withdrawSuccess'])->name('withdrawsuccess');

    Route::get('/account-deposit/{id}', [AgentController::class, 'depositDisplay'])->name('deposit.display');
    Route::post('/account-deposit/{id}/process', [AgentController::class, 'depositPost'])->name('deposit.post');
    Route::get('/deposit-success', [SuccessController::class, 'depositSuccess'])->name('depositsuccess');

    Route::get('/transfer/{id}', [AgentController::class, 'transferDisplay'])->name('transfer.display');
    Route::post('/transfer/{id}/process', [AgentController::class, 'transferPost'])->name('transfer.post');
    Route::get('/transfer-success', [SuccessController::class, 'transferSuccess'])->name('transfersuccess');
    Route::get('/transfer-error', [ErrorController::class, 'transferCurrError'])->name('diffcurrencies');


    Route::get('/agentdashboard/transactionsagent', [TransactionController::class, 'transactionView'])->name('transactionsA');
    Route::get('/agentdashboard/transactions/deposits', [TransactionController::class, 'depositView'])->name('deposits.route');
    Route::get('/agentdashboard/transactions/withdrawals', [TransactionController::class, 'withdrawalView'])->name('withdrawals.route');
    Route::get('/agentdashboard/transactions/transfers', [TransactionController::class, 'transfersView'])->name('transfers.route');


    Route::get('/agentdashboard/allusers', [AgentController::class, 'getAllUsers'])->name('listusers');
    Route::get('/agentdashboard/allusers/{id}', [AgentController::class, 'getUserAccounts'])->name('user.accounts');
    Route::get('/agentdashboard/allusers/gettransactions/{id}', [TransactionController::class, 'transactionsAgentGet'])->name('usertransactions');
    Route::get('/agentdashboard/allusers/getUsertransactions/{id}', [TransactionController::class, 'transactionsClientAgentGet'])->name('transactions.Agentget');

    
    
});