<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        if(auth()->check() && auth()->user()->is_admin) {
            return view('admin.dashboard');
        } else {
           return view('dashboard');
        }
    }
}
