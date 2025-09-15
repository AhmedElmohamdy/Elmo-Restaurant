@extends('Shared_Layouts.SharedAdminView')
  
@section('Title') Update Slider @endsection


@section('Content')
<form method="POST" action="{{route('Admin.SaveSlider')}}"  enctype="multipart/form-data">
    @csrf
   

    <input type="hidden" style="width: 100%" name="id" id="id"  value="{{ $Slider->id }}" >

    <label>Title:</label>
    <input type="text"  style="width: 100%" name="title" id="title" value="{{ $Slider->title }}" required>



  <label>Description:</label>
  <input type="text" style="width: 100%" name="description" id="description" value="{{ $Slider->description }}" required>


  

  <label>Current Image:</label><br>
    <img src="{{ asset($Slider->image) }}" id="image"  width="200"  height="200" ><br>

    
        <label>New Image (optional):</label>
        <input type="file"  id="image" name="image"  class="form-control"  >

  <button type="submit"  class="btn btn-success">UpDate</button>
  </form>
@endsection

