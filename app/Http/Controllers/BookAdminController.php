<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; 

class BookAdminController extends Controller
{
     public function index()
    {
       $Result = Book::latest()->get();
        return view('Admin.Book.List', ['Book' => $Result]);
       
    }

      //Edit Booking
    public function EditBooking($id)
    {
        $Book = Book::findOrFail($id);
        return view('Admin.Book.Update', compact('Book'));
    }

    //Delete Booking
    public function DeleteBooking($id)
    {
        $Book = Book::findOrFail($id);
        $Book->delete();
        return redirect()->route(route:'Admin.GetBook',parameters:$id)->with('success', 'Book Deleted Successfully!');   
    }
}
