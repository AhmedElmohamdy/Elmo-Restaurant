@extends('Shared_Layouts.SharedAdminView')
  
@section('Title') Update Category @endsection


@section('Content')
<form method="POST" action="{{route('Admin.SaveCategory')}}"  enctype="multipart/form-data">
    @csrf
   

    <input type="hidden" style="width: 100%" name="id" id="id"  value="{{ $Categories->id }}" >

    <label>Category Name:</label>
    <input type="text"  style="width: 100%" name="category_name" id="category_name" value="{{ $Categories->category_name }}" required>

    


 




  <label>Description:</label>
  <input type="text" style="width: 100%" name="description" id="description" value="{{ $Categories->description }}" required>


  

  <label>Current Image:</label><br>
    <img src="{{ asset($Categories->image_name) }}" id="image_name"  width="200"  height="200" ><br>

    
        <label>New Image (optional):</label>
        <input type="file"  id="image_name" name="image_name"  class="form-control"  >

  <button type="submit"  class="btn btn-success">UpDate</button>
  </form>
@endsection

