@extends('Shared_Layouts.Shared')

@section('Title')
    Menu
@endsection


@section('Content')
    <section class="food_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our Menu
                </h2>
            </div>

            <ul class="filters_menu">
                <li class="active" data-filter="*">All</li>
                @foreach ($categories as $category)
                    <li data-filter="._{{ $category->id }}">
                        {{ $category->category_name }}</li>
                @endforeach
            </ul>

            <div class="filters-content">
                <div class="row grid">
                    @foreach ($Products as $Pros)
                        <div class="col-sm-6 col-lg-4 _{{ $Pros->category_id }}">
                            <div class="box">
                                <div>
                                    <div class="img-box">
                                        <a href="{{ route('Product.GetProductDetails', $Pros->id) }}">
                                            <img src="{{ url($Pros->image_name) }}" alt="{{ $Pros->product_name }}">
                                        </a>
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            {{ $Pros->product_name }}
                                        </h5>
                                        <p>
                                            {{ $Pros->description }}
                                        </p>
                                        <div class="options">
                                            <h6>{{ $Pros->price }} EGP</h6>
                                            
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>

        </div>
    </section>

@endsection