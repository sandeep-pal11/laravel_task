<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show Register Page
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle Register
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'email'      => 'required|email|unique:users',
            'phone_number' => 'required|digits:10',
            'password'   => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'role_id' => 3, // Customer role by default
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone_number' => $request->phone_number,
            'password'   => Hash::make($request->password),
        ]);

        return redirect()->route('login.page')->with('success', 'Registered Successfully!');
    }

    // Show Login Page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();

            //  Role based redirect
            if ($user->role_id == 1) {
                return redirect()->route('super.dashboard')->with('success', 'Welcome Super Admin!');
            } elseif ($user->role_id == 2) {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            } else {
                return redirect()->route('customer.profile')->with('success', 'Welcome Customer!');
            }
        }

        return back()->with('error', 'Invalid Credentials!');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.page');
    }
}
