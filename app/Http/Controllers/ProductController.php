<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;



class ProductController extends Controller
{
    //Get AllProduct , Product By Category Id
    public function GetAllProductCategoryAction($CatId = null)
    {

        if (!$CatId) {
            // Get all products with pagination
            $Result = Product::paginate(6);
            //dd($Result);
            return view('Products.Product', ['Product' => $Result]);
        } else {
            // Get products by category ID
            $Result = product::where('category_id', $CatId)->paginate(4);
            //dd($Result);
            return view('Products.Product', ['Product' => $Result]);
        }
    }

    //Get Product Details
    public function GetProductDetails($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);
        return view('Products.ProductsDetails', compact('product'));
    }


    public function Menu()
    {
        $categories = category::all();
        $Products = Product::all();
        return view('Products.Menu', ['categories' => $categories, 'Products' => $Products]);
    }


  
}
