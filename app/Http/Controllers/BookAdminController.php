<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\BookingAcceptedMail;
use App\Models\Book;
use Illuminate\Http\Request;

class BookAdminController extends Controller
{
    public function index()
    {
        $Result = Book::latest()->get();
        return view('Admin.Book.List', ['Book' => $Result]);
    }

    public function AcceptBooking($id)
    {
        $Book = Book::findOrFail($id);

        if ($Book->status === 'accepted') {
            return response()->json([
                'success' => false,
                'message' => 'This booking is already accepted.'
            ]);
        }

        $Book->status = 'accepted';
        $Book->save();

        Mail::to($Book->email)->send(new BookingAcceptedMail($Book));

        return response()->json([
            'success' => true,
            'message' => "Booking for {$Book->name} accepted and confirmation email sent!"
        ]);
    }

    public function DeleteBooking($id)
    {
        $Book = Book::findOrFail($id);
        $Book->delete();
        return redirect()->route('Admin.GetBook')->with('success', 'Booking Deleted Successfully!');
    }
}
