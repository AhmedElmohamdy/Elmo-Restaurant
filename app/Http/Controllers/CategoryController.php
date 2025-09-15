<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function GetAllCategories()
    {

        $categories = Category::all();
        return view('Categories.Categories', [ 'categories' => $categories]);

    }
}
