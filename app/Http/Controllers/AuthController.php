<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Agent;

class AuthController extends Controller
{
    public function signin_form(){
        return view('signin');
    }

    public function signupPost(Request $req)
{
    $req->validate([
        'fname' => 'required',
        'lname' => 'required',
        'dob' => 'required',
        'email' => [
            'required',
            'email',
            Rule::unique('users', 'email'), // Check uniqueness in users table
            Rule::unique('agents', 'email'), // Check uniqueness in agents table
        ],
        'password' => 'required',
    ]);

    $data['first_name'] = $req->fname;
    $data['last_name'] = $req->lname;
    $data['date_of_birth'] = $req->dob;
    $data['email'] = $req->email;
    $data['password'] = $req->password; // Might change to Hash::make($req->password);

    $user = User::create($data);

    if (!$user) {
        return redirect(route('signin'))->with("error", "Registration failed");
    }

    return redirect(route('signin'))->with("success", "Registration successful, Login to access the app");
}


    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', '=', $request->email)->first();
        $agent = Agent::where('email', '=', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                session(['loginId' => $user->user_id]);

                return redirect()->intended('/userdashboard');
            }
            else{
                return back()->withErrors(['email' => 'Invalid login credentials']);
            }
        }
        else if($agent){
            if(md5($request->password) === $agent->password){
                session(['agentId' => $agent->agent_id]);

                return redirect()->intended('/agentdashboard');
            }
            else{
                return back()->withErrors(['email' => 'Invalid login credentials']);
            }
        }
        else{
            return back()->withErrors(['email' => 'Invalid login credentials']);
        }
    }

    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return view('logout');
        }
        return redirect('signin');
    }
    public function logoutagent(){
        if(Session::has('agentId')){
            Session::pull('agentId');
            return view('logout');
        }
        return redirect('signin');
    }


}
