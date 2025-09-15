@extends('Shared_Layouts.Shared')

@section('Title')
    All Categories
@endsection


@section('Content')
   <div class="container py-5">
    <h1 class="text-center mb-5 fw-bold text-primary">All Categories</h1>

    <div class="row justify-content-center">
        @foreach($categories as $category)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <img src="{{ url($category->image_name) }}" class="card-img-top rounded-top" alt="{{ $category->image_name }}" style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-dark fw-semibold">{{ $category->category_name }}</h5>
                        <p class="card-text text-muted">{{ $category->description }}</p>
                        
                        <a href="{{route('Product.GetAllProduct',$category->id)}}" class="mt-auto btn btn-outline-primary w-100">View Items</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
