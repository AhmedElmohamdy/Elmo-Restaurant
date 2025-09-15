@extends('Shared_Layouts.SharedAdminView')
  
@section('Title') Update Settings @endsection


@section('Content')
<form method="POST" action="{{route('Admin.SaveSettings')}}"  enctype="multipart/form-data">
    @csrf
   

    <input type="hidden" style="width: 100%" name="id" id="id"  value="{{ $Settings->id }}" >

    <label>Site Name:</label>
    <input type="text" style="width: 100%" name="site_name" id="site_name"  value="{{ $Settings->site_name }}" class="form-control" required><br>

    <label>Address:</label>
    <input type="text" style="width: 100%" name="address" id="address"  value="{{ $Settings->address }}" class="form-control" required><br>

    <label>Phone:</label>
    <input type="text" style="width: 100%" name="phone" id="phone"  value="{{ $Settings->phone }}" class="form-control" required><br>

    <label>Email:</label>
    <input type="email" style="width: 100%" name="email" id="email"  value="{{ $Settings->email }}" class="form-control" required><br>

    <label>Facebook:</label>
    <input type="text" style="width: 100%" name="facebook" id="facebook"  value="{{ $Settings->facebook }}" class="form-control" required><br>

    <label>Twitter:</label>
    <input type="text" style="width: 100%" name="twitter" id="twitter"  value="{{ $Settings->twitter }}" class="form-control" required><br>

    <label>Instagram:</label>
    <input type="text" style="width: 100%" name="instagram" id="instagram"  value="{{ $Settings->instagram }}" class="form-control" required><br>

    <label>About Us:</label>
    <textarea style="width: 100%" name="about_us" id="about_us"  class="form-control" required>{{ $Settings->about_us }}</textarea><br>

    <label>Opening Days:</label>
    <input type="text" style="width: 100%" name="opening_days" id="opening_days"  value="{{ $Settings->opening_days }}" class="form-control" required><br>

    <label>Opening Hours:</label>
    <input type="text" style="width: 100%" name="opening_hours" id="opening_hours"  value="{{ $Settings->opening_hours }}" class="form-control" required><br>




  

  <label>Current Image:</label><br>
    <img src="{{ asset($Settings->logo) }}" id="logo"  width="200"  height="200" ><br>

    
        <label>New Image (optional):</label>
        <input type="file"  id="logo" name="logo"  class="form-control"  >

  <button type="submit"  class="btn btn-success">UpDate</button>
  </form>
@endsection

