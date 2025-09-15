@extends('Shared_Layouts.SharedAdminView')
@section('Title')
    Add New Category
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
                        <h3>Add New Category</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" id="CategoryForm" action="{{route('Admin.SaveCategory')}}" enctype="multipart/form-data" >
                            @csrf

                            <p>
                                {{--name and id should be same of names on DB--}}
                                <input type="text" style="width: 100%" placeholder="Category Name" name="category_name" id="category_name" required>
                                @if ($errors->has('category_name'))
                                <span style="color: red;">{{ $errors->first('category_name') }}</span>
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
                            
                            <button type="submit" id="submitButton" class="btn btn-success">Add Category</button>


                            <script>
                                document.getElementById("CategoryForm").addEventListener("submit", function(event) {
                                    event.preventDefault(); // Stop form submission
                                    alert("Category Added Successfully!"); 
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
