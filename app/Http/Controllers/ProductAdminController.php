<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    public function index()
    {
        $Result = product::with('category')->get();
        return view('Admin.Product.List', ['Product' => $Result]);
       
    }

     //Add New Product
    public function AddNewProduct()
    {
        $categories = Category::all();
        return view('Admin.Product.AddNew', ['SelectCategory' => $categories]);
        //dd($Result);
    }

    //Save New Product
     public function Save(Request $request)
    {
        $request->validate([
            'product_name' => ['required','max:30'],
            'price' => ['required', 'numeric'],
            'image_name' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'description' => 'required',
            'category_id' => 'required',
        ]);

        //Update product State
        if ($request->id) {
            // dd($request->all());
            $CurrentProduct = Product::find($request->id);
            $CurrentProduct->product_name = $request->product_name;
            $CurrentProduct->price = $request->price;
            $CurrentProduct->category_id = $request->category_id;
            $CurrentProduct->description = $request->description;
            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');
                // Generate a unique filename
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // Move the image to public/assets/img/products/
                $image->move(public_path('Uploads/products/'), $imageName);
                // Store the image path (relative to public folder)
                $imagePath = 'Uploads/products/' . $imageName;
                $CurrentProduct->image_name = $imagePath;
            }
            $CurrentProduct->Save();
            return redirect()->route('Admin.GetProduct')->with('success', 'Product Updated Successfully!');
        }

        //Save product State
        else {
            $imagePath ='';
            // Check if an image is uploaded
            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');

                // Generate a unique filename
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Move the image to public/assets/img/products/
                $image->move(public_path('Uploads/products/'), $imageName);

                // Store the image path (relative to public folder)
                $imagePath = 'Uploads/products/' . $imageName;
            } 

            $NewProduct = new product();
            $NewProduct->product_name = $request->product_name;
            $NewProduct->price = $request->price;
            $NewProduct->image_name = $imagePath;
            $NewProduct->category_id = $request->category_id;
            $NewProduct->description = $request->description;
            $NewProduct->save();

            return redirect()->route('Admin.GetProduct')->with('success', 'Product added successfully!');
            //dd($Result);
        }
    }
     //Edit
    public function Edit($id= null)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('Admin.Product.Update', compact('product', 'categories'));
    }
    //Delete Product
    public function DeleteProduct($id = null)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('Admin.GetProduct')->with('success', 'Product deleted successfully!');     
    }
}
