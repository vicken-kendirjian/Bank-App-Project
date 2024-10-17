<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;

class TransactionController extends Controller
{
    public function transactionView(){
        error_log('here we are');
        return view('transaction');
    }

    public function depositView(){
        $deposits = Transaction::where('type', 1)->get();

        return view('deposittrans', compact('deposits'));
    }

    public function withdrawalView(){
        $withdrawals = Transaction::where('type', 2)->get();

        return view('withdrawaltrans', compact('withdrawals'));
    }

    public function transfersView(){
        $transfers = Transaction::where('type', 3)->get();

        return view('transferstrans', compact('transfers'));
    }
    
   


    public function transactionsAgentGet(Request $request, $id){
        
        $account_id = $id;
        $trans_send = Transaction::where('sender', $account_id)->get();
        $tran_send_json = json_decode($trans_send, true);
        $trans_rec = Transaction::where('receiver',$account_id)->get();
        $trans_rec_json = json_decode($trans_rec, true);
        $mergedArray = array_merge($tran_send_json, $trans_rec_json);
        $mergedJsonData = json_encode($mergedArray);
        $sortedTransactions = collect(json_decode($mergedJsonData))->sortByDesc('date');
        return view('transactionsAgent', ['transactions' => $sortedTransactions, 'userId' => $account_id]);
    }

    public function transactionsClientAgentGet(Request $request, $id){
        $clientId = $id;
        $clientAccounts = Account::where('client_id', $clientId)->pluck('account_id');
        $transactions = Transaction::where(function ($query) use ($clientAccounts) {
            $query->whereIn('sender', $clientAccounts)
                  ->orWhereIn('receiver', $clientAccounts);
        })->get();
        $sortedTransactions = $transactions->sortByDesc('date');
        return view('transactionsAgentClient', ['transactions' => $sortedTransactions, 'userId' => $clientId]);
    }
    

    public function transactionsGet(Request $request){
        $clientId = $request->session()->get('loginId');
        $clientAccounts = Account::where('client_id', $clientId)->pluck('account_id');
        $transactions = Transaction::where(function ($query) use ($clientAccounts) {
            $query->whereIn('sender', $clientAccounts)
                  ->orWhereIn('receiver', $clientAccounts);
        })->get();
        $sortedTransactions = $transactions->sortByDesc('date');
        return view('transactions', ['transactions' => $sortedTransactions]);
    }

    public function transactionsGetAccount(Request $request, $account_number){
        $clientId = $request->session()->get('loginId');
        $account = Account::where('account_number',$account_number)->first();
        $account_id = $account->account_id;
        $trans_send = Transaction::where('sender', $account_id)->get();
        $tran_send_json = json_decode($trans_send, true);
        $trans_rec = Transaction::where('receiver',$account_id)->get();
        $trans_rec_json = json_decode($trans_rec, true);
        $mergedArray = array_merge($tran_send_json, $trans_rec_json);
        $mergedJsonData = json_encode($mergedArray);
        $sortedTransactions = collect(json_decode($mergedJsonData))->sortByDesc('date');
        return view('transactions', ['transactions' => $sortedTransactions]);
    }
    
}
