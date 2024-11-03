<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Show login page
    public function index(){
        return view('Login');
    }

    // Authenticate and redirect based on user type
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.login')
                ->withInput()
                ->withErrors($validator);
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // Redirect based on user type
            if ($user->user_type == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->user_type == 'user') {
                return redirect()->route('account.dashboard');
            }

        } else {
            return redirect()->route('account.login')->withErrors('Email or Password incorrect');
        }
    }

    // Show register page
    public function register(){
        return view('register');
    }

    // Process user registration
    public function processRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'name' => 'required',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.register')
                ->withInput()
                ->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 'user'; // Set user type
        $user->save();

        return redirect()->route('account.login')->with('success', 'You have registered successfully');
    }

    // Log out the user/admin
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    // Show password request form
    public function passwordRequest(){
        return view('forgetpassword');
    }
}
