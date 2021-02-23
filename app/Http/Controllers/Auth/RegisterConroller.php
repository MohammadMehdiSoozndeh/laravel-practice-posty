<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterConroller extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.register ');
    }

    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'name' => 'required|max:255|min:2',
            'username' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed'
        ]);

        // Store User
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Sign the user in
        auth()->attempt($request->only('email', 'password'));

        // Redirect
        return redirect()->route('dashboard');
    }
}
