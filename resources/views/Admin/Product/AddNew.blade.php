@extends('Shared_Layouts.SharedAdminView')
@section('Title')
    Add New Product
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
                        <h3>Add New Product</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" id="CategoryForm" action="{{route('Admin.SaveProduct')}}" enctype="multipart/form-data" >
                            @csrf

                            <p>
                                {{--name and id should be same of names on DB--}}
                                <input type="text" style="width: 100%" placeholder="Product Name" name="product_name" id="product_name" required>
                                @if ($errors->has('product_name'))
                                <span style="color: red;">{{ $errors->first('product_name') }}</span>
                            @endif
                            </p>


                             <p style="display: flex">
                                <input type="number" style="width: 20%" class="mr-3" placeholder="Product Price" name="price" id="price" min="0" required>
                                @if ($errors->has('price'))
                                <span style="color: red;">{{ $errors->first('price') }}</span>
                            @endif
                             </p>


                           <p>
                                <select name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach ($SelectCategory as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span style="color: red;">{{ $errors->first('category_id') }}</span>
                                @endif
                            </p>

                          
                            <p>
                                <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" required></textarea>
                                @if ($errors->has('description'))
                                <span style="color: red;">{{ $errors->first('description') }}</span>
                            @endif
                            </p>

                           

                            <p>

                                <input type="file" name="image_name" id="image_name" class="form-control" required >
                                @if ($errors->has('image_name'))
                                    <span style="color: red;">{{ $errors->first('image_name') }}</span>
                                @endif
                                
                            </p>
                            
                            <button type="submit" id="submitButton" class="btn btn-success">Add Product</button>


                            <script>
                                document.getElementById("CategoryForm").addEventListener("submit", function(event) {
                                    event.preventDefault(); // Stop form submission
                                    alert("Product Added Successfully!"); 
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
