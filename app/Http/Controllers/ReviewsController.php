<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewsController extends Controller
{
    public function index()
    {
        return view('reviews.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'  => [
                'required',
                'email:rfc,dns',
                'max:150',
                'regex:/^[\w\.-]+@gmail\.com$/i', 
            ],
            'phone'   => 'required|string|max:20',
            'review'  => 'required|string|max:500',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'message' => $request->review,
            'rating'  => $request->rating,
        ]);

        return redirect()->route('home.index')->with('success', 'Thank you for your review!');
    }
}
