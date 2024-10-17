<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuccessController extends Controller
{
    public function accountActivated(){
        return view('agentsuccess.accountactivated');
    }
    public function accountRejected(){
        return view('agentsuccess.accountrejected');
    }

    public function accountBlocked(){
        return view('agentsuccess.accountblocked');
    }
    public function accountUnblocked(){
        return view('agentsuccess.accountunblocked');
    }
    public function withdrawSuccess(){
        return view('agentsuccess.withdrawsuccess');
    }
    public function depositSuccess(){
        return view('agentsuccess.depositsuccess');
    }
    public function transferSuccess(){
        return view('agentsuccess.transfersuccess');
    }
}
