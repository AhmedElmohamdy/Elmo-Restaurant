<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
   public function index()
   {
     $Settings = Setting::all();
       return view('Admin.Settings.List',[  'Settings'=>$Settings]);
   } 

   public function AddNewSettings()
   {
       return view('Admin.Settings.AddNew');
   }

    public function Save(Request $request)
    {
        $request->validate([
            'site_name' => ['required','max:30'],
            'logo' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'address' => ['nullable','max:100'],
            'phone' => ['nullable','max:15'],
            'email' => ['nullable','email','max:50'],
            'facebook' => ['nullable','url','max:100'],
            'twitter' => ['nullable','url','max:100'],
            'instagram' => ['nullable','url','max:100'],
            'about_us' => ['nullable'],
            'opening_days' => ['required','max:50'],
            'opening_hours' => ['required','max:50'],
        ]);

        //Update Settings State
        if ($request->id) {
            // dd($request->all());
            $CurrentSettings = Setting::find($request->id);
            $CurrentSettings->site_name = $request->site_name;
            $CurrentSettings->address = $request->address;
            $CurrentSettings->phone = $request->phone;
            $CurrentSettings->email = $request->email;
            $CurrentSettings->facebook = $request->facebook;
            $CurrentSettings->twitter = $request->twitter;
            $CurrentSettings->instagram = $request->instagram;
            $CurrentSettings->about_us = $request->about_us;
            $CurrentSettings->opening_days = $request->opening_days;
            $CurrentSettings->opening_hours = $request->opening_hours;
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                // Generate a unique filename
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // Move the image to public/assets/img/Settings/
                $image->move(public_path('Uploads/Settings/'), $imageName);
                // Store the image path (relative to public folder)
                $imagePath = 'Uploads/Settings/' . $imageName;
                $CurrentSettings->logo = $imagePath;
            }
            $CurrentSettings->Save();
            return redirect()->route('Admin.GetSettings')->with('success', 'Settings Updated Successfully!');
        }

        //Save Settings State
        else {
            $imagePath ='';
            // Check if an image is uploaded
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');

                // Generate a unique filename
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Move the image to public/assets/img/Settings/
                $image->move(public_path('Uploads/Settings/'), $imageName);

                // Store the image path (relative to public folder)
                $imagePath = 'Uploads/Settings/' . $imageName;
            } 

            $NewProduct = new Setting();
            $NewProduct->site_name = $request->site_name;
            $NewProduct->address = $request->address;
            $NewProduct->phone = $request->phone;
            $NewProduct->email = $request->email;
            $NewProduct->facebook = $request->facebook;
            $NewProduct->twitter = $request->twitter;
            $NewProduct->instagram = $request->instagram;
            $NewProduct->about_us = $request->about_us;
            $NewProduct->opening_days = $request->opening_days;
            $NewProduct->opening_hours = $request->opening_hours;
            $NewProduct->logo = $imagePath;
            $NewProduct->save();

            return redirect()->route('Admin.GetSettings')->with('success', 'Settings added successfully!');
            //dd($Result);
        }
    }

        //Edit
    public function EditSettings($id= null)
    {
        $Settings = Setting::findOrFail($id);
        return view('Admin.Settings.Update',['Settings'=>$Settings]);
    }

    public function DeleteSettings($id)
    {
        $Settings = Setting::findOrFail($id);
        $Settings->delete();
        return redirect()->route('Admin.GetSettings')->with('success', 'Settings deleted successfully!');
    }

   

}
