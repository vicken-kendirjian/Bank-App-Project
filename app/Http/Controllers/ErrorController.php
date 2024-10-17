<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function accountNotFound(){
        return view('agenterrors.account_not_found');
    }
    public function withdrawExceeded(){
        return view('agenterrors.withdrawexceeded');
    }

    public function transferCurrError(){
        return view('agenterrors.transferdiffcurr');
    }

    
}
