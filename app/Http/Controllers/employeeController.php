<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class employeeController extends Controller
{
    public function register(){
        return view('register');
    }

    public function store(Request $request){
        $request->validate([
            'username'=> 'required|min:3|alpha_num',
            'emailid' => 'required|email|unique:employees',
            'password' => 'required|min:6'
        ]);
        
        $emp = Employee::create([
            'username' => $request->username,
            'emailid' => $request->emailid,
            'password' => Hash::make($request->password)
        ]);    

        Auth::login($emp);

        return redirect('/login')->with('success', 'User registered successfully');    
    }

}
