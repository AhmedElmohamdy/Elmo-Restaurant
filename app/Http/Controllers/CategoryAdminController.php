<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryAdminController extends Controller
{
    
    public function index()
    {
       $Result = Category::latest()->get();
        //dd($Result);
        return view('Admin.Category.List', ['category' => $Result]);
       
    }

    //Add New Product
    public function AddNewCategory()
    {
        
        return view('Admin.Category.AddNew');
        //dd($Result);
    }

//Save New Product
    public function Save(Request $request)
    {
        $request->validate([
            'category_name' => ['required','max:30'],
            'description' => 'required',
            'image_name' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        //Update Category State
        if ($request->id) {
            // dd($request->all());
            $CurrentCategory = Category::find($request->id);
            $CurrentCategory->category_name = $request->category_name;
            $CurrentCategory->description = $request->description;
            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');
                // Generate a unique filename
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // Move the image to public/assets/img/Category/
                $image->move(public_path('Uploads/Categories/'), $imageName);
                // Store the image path (relative to public folder)
                $imagePath = 'Uploads/Categories/' . $imageName;
                $CurrentCategory->image_name = $imagePath;
            }
            $CurrentCategory->Save();
            return redirect()->route('Admin.GetCategory')->with('success', 'Category Updated Successfully!');
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
                $image->move(public_path('Uploads/Categories/'), $imageName);

                // Store the image path (relative to public folder)
                $imagePath = 'Uploads/Categories/' . $imageName;
            } 

            $NewCategory = new Category();
            $NewCategory->category_name = $request->category_name;
            $NewCategory->description = $request->description;
            $NewCategory->image_name = $imagePath;
            $NewCategory->save();

            return redirect()->route('Admin.GetCategory')->with('success', 'Category added successfully!');
            //dd($Result);
        }
    }
     //Edit Category
    public function EditCategory($id)
    {
        $Categories = Category::findOrFail($id);
        return view('Admin.Category.Update', compact('Categories'));
    }

    //Delete Category
    public function DeleteCategory($id)
    {
        $Category = Category::findOrFail($id);
        $Category->delete();
        return redirect()->route(route:'Admin.GetCategory',parameters:$id)->with('success', 'Category Deleted Successfully!');   
    }


}
