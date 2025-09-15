@extends('Shared_Layouts.SharedAdminView')
  
@section('Title') Update About Section @endsection


@section('Content')
<form method="POST" action="{{route('Admin.SaveAbout')}}"  enctype="multipart/form-data">
    @csrf
   

    <input type="hidden" style="width: 100%" name="id" id="id"  value="{{ $About->id }}" >

    <label>Title:</label>
    <input type="text"  style="width: 100%" name="title" id="title" value="{{ $About->title }}" required>

    


 




  <label>Description:</label>
  <input type="text" style="width: 100%" name="description" id="description" value="{{ $About->description }}" required>


  

  <label>Current Image:</label><br>
    <img src="{{ asset($About->image_name) }}" id="image_name"  width="200"  height="200" ><br>

    
        <label>New Image (optional):</label>
        <input type="file"  id="image_name" name="image_name"  class="form-control"  >

  <button type="submit"  class="btn btn-success">UpDate</button>
  </form>
@endsection

