<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create()
    {
        return view('users.register');
    }

    public function store(Request $request)
    {

        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // encrypt password
        $formFields['password'] = bcrypt($formFields['password']);
        // create user
        $user = User::create($formFields);
        // log user in
        auth()->login($user);
        // redirect user
        return redirect('/')->with('message', 'Account Created and Logged in Successfully');
    }

    // logout functionality
    // logout user
    public function logout(Request $request)
    {
        // logout
        auth()->logout();

        // invalidate user session and invalidate their csrf token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'you have been logged out');
    }

    // show login form
    public function login()
    {
        return view('users.login');
    }

    // login user
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            // if thats true we want to regenerate a session id
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in');
        }

        // else if the attempt fails take user back to the login page with errors. this is because we want the error to only show in the email input cos we do not want the user to know if the user exists or not
        return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
    }
}
