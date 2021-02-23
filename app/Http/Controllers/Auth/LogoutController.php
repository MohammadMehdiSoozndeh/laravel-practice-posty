<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    function store(){
        auth()->logout();
        return redirect()->route('home');
    }
}
