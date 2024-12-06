<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;

class EmployeeController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'front-user';

    public function showLoginForm()
    {
        return view('employee.login');
    }

    public function login(Request $request)
    {  
        $rules = [
            'email' => 'required|email|handle_xss',
            'password' => 'required',
        ];

        $messsages = array(
            'email.required' => 'Please enter email address',
            'email.email' => 'Please enter valid email address',
            'email.exists' => "The email address that you've entered doesn't match any records",
            'email.handle_xss' => 'Please enter valid input',
            'password.required' => 'Please enter your password',
        );

        $validator = Validator::make($request->all(), $rules, $messsages); 
        
        $credentials = $request->only('email', 'password');

        if (Auth::guard($this->guard)->attempt(['email' => $request->email, 'password' => $request->password ])) {
           return redirect()->route('EMdashboard');
        }
        // if (Auth::attempt($credentials)) { 
        //     return redirect()->route('dashboard');
        // }
        return back()->withErrors(['message' => 'Invalid login credentials']);
    }

    public function dashboard()
    {  
        return view('employee.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('front-user')->logout();
        // Auth::logout();
        return redirect('/EMlogin');
    }
}
