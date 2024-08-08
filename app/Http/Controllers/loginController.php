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

        $emailid = $request->input('emailid');
        $password = $request->input('password');

        if (Auth::attempt(['emailid' => $emailid, 'password' => $password])) {
            $emp = Employee::where('emailid', $emailid)->first();
            Auth::login($emp);
            return redirect('/users-list')->with('success', 'You are Logged in');
        } else {
            return back()->withErrors(['Invalid credentials!']);
        }
    }

    public function usersList()
    {
        $emp = Employee::get();
        return view('users-list', compact('emp'));
    }

    public function logout()
    {
        Auth::login();
        return redirect('/login');
    }
}
