<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class AboutAdminController extends Controller
{
    public function index()
    {
       $Result = About::latest()->get();
        return view('Admin.About.List', ['About' => $Result]);
       
    }

    //Add New About
    public function AddNewAbout()
    { 
        return view('Admin.About.AddNew');
    }

//Save New About
    public function Save(Request $request)
    {
        $request->validate([
            'title' => ['required','max:30'],
            'description' => 'required',
            'image_name' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        //Update About State
        if ($request->id) {
            // dd($request->all());
            $CurrentAbout = About::find($request->id);
            $CurrentAbout->title = $request->title;
            $CurrentAbout->description = $request->description;
            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');
                // Generate a unique filename
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // Move the image to public/assets/img/About/
                $image->move(public_path('Uploads/About/'), $imageName);
                // Store the image path (relative to public folder)
                $imagePath = 'Uploads/About/' . $imageName;
                $CurrentAbout->image_name = $imagePath;
            }
            $CurrentAbout->Save();
            return redirect()->route('Admin.GetAbout')->with('success', 'About Updated Successfully!');
        }

        //Save About State
        else {
            $imagePath ='';
            // Check if an image is uploaded
            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');

                // Generate a unique filename
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Move the image to public/assets/img/About/
                $image->move(public_path('Uploads/About/'), $imageName);

                // Store the image path (relative to public folder)
                $imagePath = 'Uploads/About/' . $imageName;
            } 

            $NewAbout = new About();
            $NewAbout->title = $request->title;
            $NewAbout->description = $request->description;
            $NewAbout->image_name = $imagePath;
            $NewAbout->save();

            return redirect()->route('Admin.GetAbout')->with('success', 'About added successfully!');
            //dd($Result);
        }
    }
     //Edit About
    public function EditAbout($id)
    {
        $About = About::findOrFail($id);
        return view('Admin.About.Update', compact('About'));
    }

    //Delete About
    public function DeleteAbout($id)
    {
        $About = About::findOrFail($id);
        $About->delete();
        return redirect()->route(route:'Admin.GetAbout',parameters:$id)->with('success', 'About Deleted Successfully!');   
    }
}
