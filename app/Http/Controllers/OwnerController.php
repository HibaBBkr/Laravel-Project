<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // Import the View class

class OwnerController extends Controller
{
    /**
     * Display the owner's calendar page.
     */
    public function showCalendar(): View
    {
        return view('owner.calendar'); // Assumes resources/views/owner/calendar.blade.php
    }

    /**
     * Display the owner's reviews page.
     */
    public function showReviews(): View
    {
        return view('owner.reviews'); // Assumes resources/views/owner/reviews.blade.php
    }

    /**
     * Display the form to add a new hall.
     */
    public function showAddHallForm(): View
    {
        // Assumes resources/views/owner/add-a-hall.blade.php
        // If your file is literally "Add a Hall.blade.php", Laravel might find it,
        // but it's better to rename it to "add-a-hall.blade.php"
        return view('owner.add-a-hall');
    }

    // You might also have a method to handle the submission of the "Add a Hall" form
    // public function storeHall(Request $request)
    // {
    //     // ... validation and logic to save the hall
    //     return redirect()->route('owner.addHall')->with('success', 'Hall added successfully!');
    // }
}