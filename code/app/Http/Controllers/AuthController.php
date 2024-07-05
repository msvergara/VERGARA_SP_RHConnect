<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use App\Models\User;
use App\Models\Sessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function index() {
        if(Auth::check()){
            // return redirect()->route('dashboard', ['year' => date('Y')]);
            return redirect()->intended('dashboard');
        } else {
            return view('pages.login');
        }
    } 

    public function userLogin(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $remember = $request->has('remember') ? true : false; 

        $credentials = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );

        if (Auth::attempt($credentials, $remember)) {
            // return redirect()->route('dashboard', ['year' => date('Y')]);
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        } else {
            return redirect("/")->withSuccess('Login details are not valid');
        }
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }
}
