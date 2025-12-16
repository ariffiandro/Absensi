<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginSiswaController extends Controller
{
    public function index()
    {
        return view('siswa.dashboard');
    }
}
