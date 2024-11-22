<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3' , 'max:15'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'regex:/[A-Z]/', 'regex:/[\W_]/']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request)
{
    // Validate the incoming request
    $incomingFields = $request->validate([
        'loginname' => 'required|string',
        'loginpassword' => 'required|string',
    ]);

    // Attempt to authenticate the user
    if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
        // Regenerate session to prevent session fixation
        $request->session()->regenerate();
        // Redirect to homepage
        return redirect('/');
    }

    // If authentication fails, return with errors
    return back()->withErrors([
        'loginname' => 'Invalid credentials, please try again.'
    ])->withInput();
}

}
