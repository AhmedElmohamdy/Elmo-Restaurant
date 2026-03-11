<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\offers;
use App\Models\About;
use App\Models\Book;
use App\Models\AdminNotification;
use App\Models\Review;


class HomePageController extends Controller
{

    public function indexs()
    {
        $categories = category::all();
        $Products = Product::all();
        $Offers = offers::latest()->get();
        $About = About::all();
        $Reviews = Review::all();
        return view('Home.index', ['categories' => $categories, 'Products' => $Products, 'Offers' => $Offers, 'About' => $About, 'Reviews' => $Reviews]);
    }

    public function About()
    {
        $About = About::all();
        return view('Home.About', ['About' => $About]);
    }


    public function Booking()
    {
        return view('Home.Booking');
    }
    public function SaveBooking(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:15',
            'email' => ['required', 'email', 'max:255', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'],
            'NumberOfPerson' => 'required|integer|min:1',
            'date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
        ], [
            'name.required' => 'Please enter your name.',
            'phoneNumber.required' => 'Please enter your phone number.',
            'NumberOfPerson.required' => 'Please enter the number of persons.',
            'date.required' => 'Please enter the date.',
            'date.after_or_equal' => 'You cannot book a past date.',
            'booking_time.required' => 'Please enter the booking time.',
            'email.regex' => 'Please enter a valid Gmail address (example@gmail.com).'
        ]);

        // Prevent duplicate booking for same user, date and time
        $exists = Book::where('user_id', auth()->id())
            ->where('date', $request->date)
            ->where('booking_time', $request->booking_time)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'booking_time' => 'You already have a booking at this time.'
            ])->withInput();
        }

        // Save booking and assign to a variable
        $booking = Book::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email,
            'NumberOfPerson' => $request->NumberOfPerson,
            'date' => $request->date,
            'booking_time' => $request->booking_time,
        ]);

        AdminNotification::create([
            'type'    => 'booking',
            'message' => "New booking from {$booking->name} on {$booking->date} at {$booking->booking_time}",
            'url'     => route('Admin.GetBook'),
        ]);

        return redirect()->route('home.index')
            ->with('success', 'Your reservation has been submitted successfully!');
    }
}
