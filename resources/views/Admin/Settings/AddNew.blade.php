@extends('Shared_Layouts.SharedAdminView')
@section('Title')
    Add New offer
@endsection


@section('Content')


 {{-- Display all error messages --}}
 @if ($errors->any())
 <div style="color: red;">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
@endif


    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>Add New Settings</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" id="SettingsForm" action="{{route('Admin.SaveSettings')}}" enctype="multipart/form-data" >
                            @csrf

                            <p>
                                <input type="text" name="site_name" id="site_name" style="width: 100%" placeholder="Site Name" required>
                                @if ($errors->has('site_name'))
                                    <span style="color: red;">{{ $errors->first('site_name') }}</span>
                                @endif
                            </p>


                            <p>
                                <input type="text" name="address" style="width: 100%" id="address" placeholder="Address" required>
                                @if ($errors->has('address'))
                                    <span style="color: red;">{{ $errors->first('address') }}</span>
                                @endif  
                            </p>
                            <p>
                                <input type="text" name="phone" style="width: 100%" id="phone" placeholder="Phone" required>
                                @if ($errors->has('phone'))
                                    <span style="color: red;">{{ $errors->first('phone') }}</span>
                                @endif
                            </p>
                            <p>
                                <input type="email" name="email" style="width: 100%" id="email" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span style="color: red;">{{ $errors->first('email') }}</span>
                                @endif
                            </p>
                            <p>
                                <input type="text" name="facebook" style="width: 100%" id="facebook" placeholder="Facebook" required>
                                @if ($errors->has('facebook'))
                                    <span style="color: red;">{{ $errors->first('facebook') }}</span>
                                @endif
                            </p>
                            <p>
                                <input type="text" name="twitter" style="width: 100%" id="twitter" placeholder="Twitter" required>
                                @if ($errors->has('twitter'))
                                    <span style="color: red;">{{ $errors->first('twitter') }}</span>
                                @endif
                            </p>
                            <p>
                                <input type="text" name="instagram" style="width: 100%" id="instagram" placeholder="Instagram" required>
                                @if ($errors->has('instagram'))
                                    <span style="color: red;">{{ $errors->first('instagram') }}</span>
                                @endif
                            </p>
                            <p>
                                
                                <textarea name="about_us" id="about_us" cols="30" rows="10" placeholder="About Us" required></textarea>
                                @if ($errors->has('about_us'))
                                    <span style="color: red;">{{ $errors->first('about_us') }}</span>
                                @endif
                            </p>
                            <p>
                                <input type="text" name="opening_days" style="width: 100%" id="opening_days" placeholder="Opening Days" required>
                                @if ($errors->has('opening_days'))
                                    <span style="color: red;">{{ $errors->first('opening_days') }}</span>
                                @endif
                            </p>
                            <p>
                                <input type="text" name="opening_hours" style="width: 100%" id="opening_hours" placeholder="Opening Hours" required>
                                @if ($errors->has('opening_hours'))
                                    <span style="color: red;">{{ $errors->first('opening_hours') }}</span>
                                @endif
                            </p>



                            <p>
                                <input type="file" name="logo" id="logo" style="width: 100%" class="form-control" required >
                                @if ($errors->has('logo'))
                                    <span style="color: red;">{{ $errors->first('logo') }}</span>
                                @endif
                                
                            </p>
                            
                            <button type="submit" id="submitButton" class="btn btn-success">Save</button>


                            <script>
                                document.getElementById("SettingsForm").addEventListener("submit", function(event) {
                                    event.preventDefault(); // Stop form submission
                                    alert("Settings Added Successfully!"); 
                                    this.submit(); // Submit the form after showing the message
                                });
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
