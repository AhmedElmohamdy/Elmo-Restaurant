<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class AdminReviewsController extends Controller
{
    public function index()
    {
        $Results = Review::all();
        return view('Admin.Reviews.List', ['Results' => $Results]);
    }

    public function DeleteReview($id)
    {
        $review = Review::find($id);
            $review->delete();
            return redirect()->route('Admin.GetReviews')->with('success', 'Review deleted successfully.');
       
    }
}
