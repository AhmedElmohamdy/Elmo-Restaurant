<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
  

    public function index()
    {
        // Fetch all sliders from the database
        $Slider = Slider::all();
        return view('Admin.Slider.List', ['Slider' => $Slider]);
    }

    // Show the form to add a new slider
    public function AddNewSlider()
    {
        return view('Admin.Slider.AddNew');
    }

   //Save New Slider
    public function Save(Request $request)
    {
        $request->validate([
            'title' => [ 'max:100'],
            'description' => [ 'max:500'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

        ]);

        //Update Slider State
        if ($request->id) {
            // dd($request->all());
            $CurrentSlider = Slider::find($request->id);
            $CurrentSlider->title = $request->title;
            $CurrentSlider->description = $request->description;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                // Generate a unique filename
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // Move the image to public/assets/img/Slider/
                $image->move(public_path('Uploads/Slider/'), $imageName);
                // Store the image path (relative to public folder)
                $imagePath = 'Uploads/Slider/' . $imageName;
                $CurrentSlider->image = $imagePath;
            }
            $CurrentSlider->Save();
            return redirect()->route('Admin.GetSlider')->with('success', 'SliderPhoto Updated Successfully!');
        }

        //Save Slider State
        else {
            $imagePath = '';
            // Check if an image is uploaded
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Generate a unique filename
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Move the image to public/assets/img/Slider/
                $image->move(public_path('Uploads/Slider/'), $imageName);

                // Store the image path (relative to public folder)
                $imagePath = 'Uploads/Slider/' . $imageName;
            }

            $NewSlider = new Slider();
            $NewSlider->title = $request->title;
            $NewSlider->description = $request->description;
            $NewSlider->image = $imagePath;
            $NewSlider->save();

            return redirect()->route('Admin.GetSlider')->with('success', 'SliderPhoto added successfully!');
            //dd($Result);
        }
    }






     //Edit
    public function EditSlider($id)
    {
        $Slider = Slider::findOrFail($id);
        return view('Admin.Slider.Update', compact('Slider'));
    }

}
