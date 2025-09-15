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
                        <h3>Add New offer</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" id="offerForm" action="{{route('Admin.SaveOffer')}}" enctype="multipart/form-data" >
                            @csrf

                            <p>
                                {{--name and id should be same of names on DB--}}
                                <input type="text" style="width: 100%" placeholder="Title" name="title" id="title" required>
                                @if ($errors->has('title'))
                                <span style="color: red;">{{ $errors->first('title') }}</span>
                            @endif
                            </p>


                           

                          
                            <p>
                                <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" required></textarea>
                                @if ($errors->has('description'))
                                <span style="color: red;">{{ $errors->first('description') }}</span>
                            @endif
                            </p>

                           
                            <p>
                                <input type="number" name="discount" id="discount" placeholder="Discount Ex 20" required>
                                @if ($errors->has('discount'))
                                    <span style="color: red;">{{ $errors->first('discount') }}</span>
                                @endif  
                            </p>

                            <p>
                                <input type="date" name="start_date" id="start_date" required>
                                @if ($errors->has('start_date'))
                                    <span style="color: red;">{{ $errors->first('start_date') }}</span>
                                @endif
                            </p>


                            <p>
                                <input type="date" name="end_date" id="end_date" required>
                                @if ($errors->has('end_date'))
                                    <span style="color: red;">{{ $errors->first('end_date') }}</span>
                                @endif
                            </p>

                            <p>
                                <input type="file" name="image_name" id="image_name" class="form-control" required >
                                @if ($errors->has('image_name'))
                                    <span style="color: red;">{{ $errors->first('image_name') }}</span>
                                @endif
                                
                            </p>
                            
                            <button type="submit" id="submitButton" class="btn btn-success">Add offer</button>


                            <script>
                                document.getElementById("offerForm").addEventListener("submit", function(event) {
                                    event.preventDefault(); // Stop form submission
                                    alert("offer Added Successfully!"); 
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
