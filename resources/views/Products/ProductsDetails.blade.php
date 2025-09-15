@extends('Shared_Layouts.Shared')

@section('Title')
     Products Details
@endsection


@section('Content')
<div class="single-product py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-5">
                <div class="single-product-img shadow-sm rounded overflow-hidden">
                    <img src="{{ asset($product->image_name) }}" alt="Product Image"
                         class="img-fluid w-100 rounded"
                         style="object-fit: cover; height: 400px;">
                </div>
            </div>

            <div class="col-lg-7 col-md-6">
                <div class="single-product-content bg-light p-4 rounded shadow-sm h-100 d-flex flex-column justify-content-center">
                    <h2 class="fw-bold text-primary mb-3">{{ $product->product_name }}</h2>
                    <h4 class="text-success mb-4"><strong>Price: </strong> {{ $product->price }} EGP</h4>
                    <p class="text-muted fs-5">{{ $product->description }}</p>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection