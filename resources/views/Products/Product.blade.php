@extends('Shared_Layouts.Shared')

@section('Title')
    All Products
@endsection


@section('Content')
    <div class="filters-content py-5 bg-light">
        <div class="container">
            <div class="row grid g-4">
                @foreach ($Product as $Pros)
                    <div class="col-sm-6 col-lg-4 _{{ $Pros->category_id }}">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <a href="{{ route('Product.GetProductDetails', $Pros->id) }}" class="d-block">
                                <div class="ratio ratio-1x1 bg-light">
                                    <img src="{{ url($Pros->image_name) }}" alt="{{ $Pros->product_name }}"
                                        class="img-fluid object-fit-cover w-100 h-100">
                                </div>
                            </a>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-semibold text-primary">{{ $Pros->product_name }}</h5>
                                <p class="card-text text-muted small">
                                    {{ \Illuminate\Support\Str::limit($Pros->description, 100) }}</p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold text-success">{{ $Pros->price }} EGP</h6>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
       
    </div>
@endsection
