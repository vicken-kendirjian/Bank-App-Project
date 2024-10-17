<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Agent;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;

class AgentController extends Controller
{
    public function agentdashboard(){
        $data = array();
        if(Session::has('agentId')){
            $data=Agent::where('agent_id', '=', Session::get('agentId'))->first();
            error_log($data->first_name);
            return view('agenthome', compact('data'));
        }
    }

    public function getPending()
    {
        $pendingAccounts = [];

        if (Session::has('agentId')) {
            // Retrieve all accounts where active is false
            $pendingAccounts = Account::with('user') // Make sure to eager load the user relationship
                ->where('active', false)
                ->get();

            return view('pendingaccounts', compact('pendingAccounts'));
        }
    }

    public function getActive()
    {
        $activeAccounts = [];

        if (Session::has('agentId')) {
            // Retrieve all accounts where active is false
            $activeAccounts = Account::with('user') // Make sure to eager load the user relationship
                ->where('active', true)
                ->get();

            return view('activeaccounts', compact('activeAccounts'));
        }
    }

    public function acceptAccount(Request $request, $id)
    {
        $account = Account::where('account_id', $id)->first();

        if (!$account) {
            // Handle the case where the account is not found, perhaps redirect or show an error
            return redirect()->route('accountnotfound');
        }
        // Update the 'active' flag to true
        Account::where('account_id', $id)->update(['active' => true]);

        // Add any additional logic or redirect as needed
        return redirect()->route('accountactivated');
        
    }

    public function rejectAccount(Request $request, $id)  
    {

    $account = Account::where('account_id', $id)->first();

    if(!$account) {
        // Handle account not found case
        return redirect()->route('accountnotfound'); 
    }

    // Delete account
    Account::where('account_id', $id)->delete();

    return redirect()->route('accountrejected'); 

    }


    public function accountBUB(Request $request, $id) {

        $account = Account::where('account_id', $id)->first();
      
        if(!$account) {
          return redirect()->route('accountnotfound');  
        }
      
        if($account->blocked) {
          Account::where('account_id', $id)->update(['blocked' => false]);
          return redirect()->route('accountunblocked');
        } else {
          Account::where('account_id', $id)->update(['blocked' => true]);
          return redirect()->route('accountblocked');
        }
      
        
      
      }


      public function withdrawDisplay($id){
        $account = Account::where('account_id', $id)->first();
        if(!$account) {
            return redirect()->route('accountnotfound');  
        }
        return view('withdrawdisplay', compact('account'));
        
      }

      public function withdrawPost(Request $request, $id){

        $account = Account::where('account_id', $id)->first();

        $amount = $request->input('amount');
        error_log(intval($amount));
        error_log($account->user->first_name);
        
        if(!$account){
            return redirect()->route('accountnotfound'); 
        }
        else if($amount > $account->amount){
            return redirect()->route('withdrawexceeded'); 
        }

        Transaction::create([
            'sender' => $id,
            'receiver' => null,
            'senderNumber' => $account->account_number,
            'amount' => $amount,
            'type' => 2, // Type 2 for withdrawal
        ]);
        
        // Withdraw directly via query
        Account::where('account_id', $id)->update(['amount' => $account->amount - $amount]);

        return redirect()->route('withdrawsuccess');
      }


      public function depositDisplay($id){
        $account = Account::where('account_id', $id)->first();
        if(!$account) {
            return redirect()->route('accountnotfound');  
        }
        return view('depositdisplay', compact('account'));
        
      }

      public function transferDisplay($id){
        $account = Account::where('account_id', $id)->first();
        if(!$account) {
            return redirect()->route('accountnotfound');  
        }
        return view('transferdisplay', compact('account'));
        
      }


      public function transferPost(Request $request, $id){
        error_log('in function');
        $account = Account::where('account_id', $id)->first();

        if(!$account){
            return redirect()->route('accountnotfound'); 
        }

        $amount= $request->input('amount');
        $destination = $request->input('destination');
        error_log($destination);

        $receiver = Account::where('account_number', $destination)
                   ->where('active', true)
                   ->where('blocked', false)
                   ->first();

          

        if($receiver){
            error_log('Receiver found');
            if(trim(strtolower($receiver->currency)) != trim(strtolower($account->currency))){
                error_log('Transfer stopped, not the same currency');

                return redirect()->route('diffcurrencies');
            }

            //take $account and reduce the $amount from its amount column
            Account::where('account_id', $account->account_id)
            ->decrement('amount', $amount);

            // Add to receiver       
            Account::where('account_number', $receiver->account_number)  
            ->increment('amount', $amount);

            Transaction::create([
                'receiver' => $receiver->account_id,
                'sender' => $id,
                'senderNumber' => $account->account_number,
                'receiverNumber' => $receiver->account_number,
                'amount' => $amount,
                'type' => 3
            ]);

            return redirect()->route('transfersuccess');
        }
        error_log("receiver not found after transfer");
        return redirect()->route('accountnotfound');
      }

      public function depositPost(Request $request, $id){
        $account = Account::where('account_id', $id)->first();

        $amount = $request->input('amount');
        error_log(intval($amount));
        error_log($account->user->first_name);
        
        if(!$account){
            return redirect()->route('accountnotfound'); 
        }
        
        Transaction::create([
            'receiver' => $id,
            'sender' => null,
            'receiverNumber' => $account->account_number,
            'amount' => $amount,
            'type' => 1, // Type 2 for withdrawal
        ]);

        // Withdraw directly via query
        Account::where('account_id', $id)->update(['amount' => $account->amount + $amount]);

        return redirect()->route('depositsuccess');
      }


      public function getAllUsers(Request $req) {
        $users = User::all();

        return view('allusersview', compact('users'));
    }

    public function getUserAccounts(Request $req, $id){

        $userAccounts = Account::where('client_id', $id)->get();
        return view('useraccountsview', compact('userAccounts'));
    }

    

}
