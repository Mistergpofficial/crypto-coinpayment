<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SigningController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showForm(){
        return view('pages.auth.login');
    }

    public function showLinkRequestForm()
    {
        return view('pages.auth.email');
    }

    public function showResetForm($token)
    {
        return view('pages.auth.reset', compact('token'));
    }

}
