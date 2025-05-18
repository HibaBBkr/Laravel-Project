<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // If Home.blade.php is in resources/views/customer/Home.blade.php
        return view('Home');

        // If Home.blade.php is directly in resources/views/Home.blade.php (as assumed before)
        // return view('Home');
    }
}