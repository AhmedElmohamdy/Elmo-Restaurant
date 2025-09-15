@extends('Shared_Layouts.SharedAdminView')
  
@section('Title') Update Product @endsection


@section('Content')
<form method="POST" action="{{route('Admin.SaveProduct')}}"  enctype="multipart/form-data">
    @csrf
   

    <input type="hidden" style="width: 100%" name="id" id="id"  value="{{ $product->id }}" >

    <label>Product Name:</label>
    <input type="text"  style="width: 100%" name="product_name" id="product_name" value="{{ $product->product_name }}" required>

        <label>Product Price:</label>
    <input type="text"  style="width: 100%" name="price" id="price" value="{{ $product->price }}" required>


 <label>Select Category:</label>
  <select class="custom-dropdown" name="category_id" style="width: 100%" required>
      <option value="">-- Select Category --</option>
      @foreach ($categories as $category)
      {{--if category id equal category id in product colum select it--}}
          <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
              {{ $category->category_name }}
          </option>
      @endforeach
  </select>




  <label>Description:</label>
  <input type="text" style="width: 100%" name="description" id="description" value="{{ $product->description }}" required>


  

  <label>Current Image:</label><br>
    <img src="{{ asset($product->image_name) }}" id="image_name"  width="200"  height="200" ><br>

    
        <label>New Image (optional):</label>
        <input type="file"  id="image_name" name="image_name"  class="form-control"  >

  <button type="submit"  class="btn btn-success">UpDate</button>
  </form>
@endsection

