<?php

namespace App\Http\Controllers; // Or App\Http\Controllers\Auth if it's an auth controller

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- This is the correct facade
// ... other necessary use statements

class YourController extends Controller
{
    public function someMethod()
    {
        if (Auth::check()) { // Now you can use Auth::
            $user = Auth::user();
            // ...
        }
    }
}