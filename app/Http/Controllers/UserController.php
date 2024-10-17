<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    public function dashboard(){

        $data = array();
        if(Session::has('loginId')){
            $data=User::where('user_id', '=', Session::get('loginId'))->first();
            return view('home', compact('data'));
        }
    }
    public function addaccount(){
        return view('addaccount');
    }
    }
