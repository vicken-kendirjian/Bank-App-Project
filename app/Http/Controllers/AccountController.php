<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;
use App\Models\Transaction;

class AccountController extends Controller
{
    // Your other methods...

    public function createAccount(Request $request)
    {
        $clientId = $request->session()->get('loginId');
        $client = User::where('user_id', $clientId)->first();
        error_log($client);
        if ($client) {
            $currency = $request->input('currency');
            $name = $request->input('account_name');
            $account = new Account();
            $account->client_id = $clientId;
            $account->currency = $currency;
            $account->account_name = $name;
            $account->save();

            // Optionally, you can return a response or redirect to another page
            return view('accountsuccess', ['account' => $account]);
        } else {
            return response()->json(['message' => 'Client not found'], 404);
        }
    }

    public function getAccounts(Request $request)
    {
        $clientId = $request->session()->get('loginId');
        $client = User::where('user_id', $clientId)->first();
        if ($client) {
            $accounts = Account::where('client_id', $clientId)->get();
            return response()->json(['accounts' => $accounts]);
        } else {
            return response()->json(['message' => 'Client not found'], 404);
        }
    }
    public function account(Request $request, $account_number)
    {
        $clientId = $request->session()->get('loginId');
        $client = User::where('user_id', $clientId)->first();

        if ($client) {
            $account = Account::where('account_number', $account_number)->first();

            if ($account) {
                if($account->blocked == 0 && $account->active == 1){
                    return view('account', ['account' => $account]);
                }
                else{
                    return view('accountaccess');
                }

            } else {
                abort(404, 'Account not found');
            }
        } else {
            abort(404, 'Client not found');
        }
    }
    public function transfer(Request $request, $account_number){

        $clientId = $request->session()->get('loginId');
        $client = User::where('user_id', $clientId)->first();

        if ($client) {
            $account = Account::where('account_number', $account_number)->first();

            if ($account) {
                return view('transfer', ['account' => $account]);
            } else {
                abort(404, 'Account not found');
            }
        } else {
            abort(404, 'Client not found');
        }
    }

    public function transferPost(Request $request, $account_number)
    {
        $clientId = $request->session()->get('loginId');
        $client = User::where('user_id', $clientId)->first();

        if ($client) {
            $sending_account = Account::where('account_number', $account_number)->first();
            $receiving_account = Account::where('account_number', $request->input('account_number'))->first();

            
            $amount = $request->input('amount');
            
            if ($receiving_account && $sending_account && ($receiving_account->currency == $sending_account->currency) && ($sending_account->account_number!=$receiving_account->account_number)) {
                Account::where('account_number', $account_number)->update(['amount' => $sending_account->amount - $amount]);
                Account::where('account_number', $request->input('account_number'))->update(['amount' => $receiving_account->amount + $amount]);

                $transaction = new Transaction();
                $transaction->sender = $sending_account->account_id;
                $transaction->receiver = $receiving_account->account_id;
                $transaction->senderNumber = $sending_account->account_number;
                $transaction->receiverNumber = $receiving_account->account_number;
                $transaction->amount = $amount;
                $transaction->type = 3;
                $transaction->save();

                return view('transfersuccess');
            } else {
                return view('transferfailure');
            }
        } else {
            return response()->json(['message' => 'Client not found'], 404);
        }
    }
}

