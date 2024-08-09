<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function validate_log(Request $request)
    {
        $request->validate([
            'emailid' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('emailid', 'password');
        if(Auth::attempt($credentials)){
            return response()->json(['message' => 'Logged in successfully'], 200);
        }else{
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
    
    public function usersList()
    {
        return view('users-list');
    }

    public function getusersList()
    {
        $emp = Employee::get();
        return response()->json($emp);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
