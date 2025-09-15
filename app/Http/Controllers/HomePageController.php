<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\offers;
use App\Models\About;
use App\Models\Book;
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
        return view('Home.index', ['categories' => $categories, 'Products' => $Products, 'Offers' => $Offers, 'About' => $About  , 'Reviews' => $Reviews]);
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
            'email' => 'required|email|max:255',
            'NumberOfPerson' => 'required|integer|min:1',
            'date' => 'required|date',
            'booking_time' => 'required|date_format:H:i',
        ]);

        $booking = new Book();
        $booking->name = $request->name;
        $booking->phoneNumber = $request->phoneNumber;
        $booking->email = $request->email;
        $booking->NumberOfPerson = $request->NumberOfPerson;
        $booking->date = $request->date;
        $booking->booking_time = $request->booking_time;
        $booking->save();

        return redirect()->route('home.index')->with('success', 'Booking saved successfully!');
    }

}
