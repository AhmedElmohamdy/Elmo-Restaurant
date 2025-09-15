@extends('Shared_Layouts.SharedAdminView')
  
@section('Title') Update Category @endsection


@section('Content')
<form method="POST" action="{{route('Admin.SaveOffer')}}"  enctype="multipart/form-data">
    @csrf
   

    <input type="hidden" style="width: 100%" name="id" id="id"  value="{{ $offers->id }}" >

    <label>Category Name:</label>
    <input type="text"  style="width: 100%" name="title" id="title" value="{{ $offers->title }}" required>

    <label>Discount:</label>
    <input type="number" style="width: 100%" name="discount" id="discount" value="{{ $offers->discount }}" required>  


    <label>Start Date:</label>
    <input type="date" style="width: 100%" name="start_date" id="start_date" value="{{ $offers->start_date }}" required>


    <label>End Date:</label>
    <input type="date" style="width: 100%" name="end_date" id="end_date" value="{{ $offers->end_date }}" required>


  <label>Description:</label>
  <input type="text" style="width: 100%" name="description" id="description" value="{{ $offers->description }}" required>


  

  <label>Current Image:</label><br>
    <img src="{{ asset($offers->image_name) }}" id="image_name"  width="200"  height="200" ><br>

    
        <label>New Image (optional):</label>
        <input type="file"  id="image_name" name="image_name"  class="form-control"  >

  <button type="submit"  class="btn btn-success">UpDate</button>
  </form>
@endsection

