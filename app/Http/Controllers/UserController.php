<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
   public function ind()
   {
       return view('index');
   }

   public function faq(){
       return view('faq');
   }
}
