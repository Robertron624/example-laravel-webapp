<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'string', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'string', 'email', 'max:200', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'max:200'],
        ]);

        // hash password
        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);

        auth()->login($user);

        return redirect('home');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginname' => ['required', 'string', 'max:10'],
            'loginpassword' => ['required', 'string', 'min:8', 'max:200'],
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {

            $request->session()->regenerate();
        }

        return redirect('home');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('home');
    }
}
