<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\offers;

class OffersAdminController extends Controller
{
    public function index()
    {
       $Result = offers::latest()->get();
        return view('Admin.offers.List', ['offers' => $Result]);
       
    }

    //Add New offers
    public function AddNewOffer()
    {
        return view('Admin.offers.AddNew');
    }

//Save New offers
    public function Save(Request $request)
    {
        $request->validate([
            'title' => ['required','max:30'],
            'description' => 'required',
            'image_name' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'discount' => ['required', 'numeric', 'min:0'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        //Update offers State
        if ($request->id) {
            $Currentoffers = offers::find($request->id);
            $Currentoffers->title = $request->title;
            $Currentoffers->discount = $request->discount;
            $Currentoffers->start_date = $request->start_date;
            $Currentoffers->end_date = $request->end_date;
            $Currentoffers->description = $request->description;
            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');
                // Generate a unique filename
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // Move the image to public/assets/img/offers/
                $image->move(public_path('Uploads/offers/'), $imageName);
                // Store the image path (relative to public folder)
                $imagePath = 'Uploads/offers/' . $imageName;
                $Currentoffers->image_name = $imagePath;
            }
            $Currentoffers->Save();
            return redirect()->route('Admin.GetOffers')->with('success', 'offers Updated Successfully!');
        }

        //Save offers State
        else {
            $imagePath ='';
            // Check if an image is uploaded
            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');

                // Generate a unique filename
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Move the image to public/assets/img/offers/
                $image->move(public_path('Uploads/offers/'), $imageName);

                // Store the image path (relative to public folder)
                $imagePath = 'Uploads/offers/' . $imageName;
            } 

            $Newoffers = new offers();
            $Newoffers->title = $request->title;
            $Newoffers->discount = $request->discount;
            $Newoffers->start_date = $request->start_date;
            $Newoffers->end_date = $request->end_date;
            $Newoffers->description = $request->description;
            $Newoffers->image_name = $imagePath;
            $Newoffers->save();
            return redirect()->route('Admin.GetOffers')->with('success', 'offers added successfully!');
        }
    }
     //Edit offers
    public function EditOffer($id)
    {
        $offers = offers::findOrFail($id);
        return view('Admin.offers.Update', compact('offers'));
    }

    //Delete Category
    public function DeleteOffer($id)
    {
        $offers = offers::findOrFail($id);
        $offers->delete();
        return redirect()->route(route:'Admin.GetOffers',parameters:$id)->with('success', 'offers Deleted Successfully!');   
    }
}
