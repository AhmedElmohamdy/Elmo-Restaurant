@extends('Shared_Layouts.Shared')

@section('Title')
    Home
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


    <!-- offer section -->
    <section class="offer_section layout_padding-bottom">
        <div class="offer_container">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>
                        Our Offers
                    </h2>
                </div>
                <div class="row">
                    @foreach ($Offers as $offer)
                        <div class="col-md-6 mb-4">
                            <div class="box">
                                <div class="img-box">
                                    <img src="{{ asset($offer->image_name) }}" alt="{{ $offer->title }}">
                                </div>
                                <div class="detail-box">
                                    <h5>{{ $offer->title }}</h5>
                                    <h6>
                                        <span>
                                            {{ rtrim(rtrim(number_format($offer->discount, 2, '.', ''), '0'), '.') }}%
                                        </span> Off
                                    </h6>
                                    @if ($offer->start_date || $offer->end_date)
                                        <p class="text-muted small mt-2">
                                            @if ($offer->start_date)
                                                From: {{ \Carbon\Carbon::parse($offer->start_date)->format('M d, Y') }}
                                            @endif
                                            @if ($offer->end_date)
                                                - To: {{ \Carbon\Carbon::parse($offer->end_date)->format('M d, Y') }}
                                            @endif
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- end offer section -->

    <!-- food section -->

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

    <!-- end food section -->

    <!-- about section -->
    <section class="about_section layout_padding">
        <div class="container  ">

            <div class="row">
                @foreach ($About as $About)
                    <div class="col-md-6 ">
                        <div class="img-box">
                            <img src="{{ url($About->image_name) }}" alt="{{ $About->image_name }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="detail-box">
                            <div class="heading_container">
                                <h2>
                                    {{ $About->title }}
                                </h2>
                            </div>
                            <p>
                                {{ $About->description }}
                            </p>
                            <a href="{{ route('home.about') }}">
                                Read More
                            </a>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- end about section -->

    <!-- book section -->
    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>Book A Table</h2>
                <p>Reserve your table in just a few seconds.</p>
                <p>Check Your Email for Confirmation</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form method="POST" id="BookForm" action="{{ route('home.saveBooking') }}">
                            @csrf
                            <div>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Your Name" required />
                                @if ($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div>
                                <input type="text" name="phoneNumber" id="phoneNumber" class="form-control"
                                    placeholder="Phone Number" required />
                                @if ($errors->has('phoneNumber'))
                                    <span style="color: red;">{{ $errors->first('phoneNumber') }}</span>
                                @endif
                            </div>
                            <div>
                               <input type="email" name="email" class="form-control"
                                        pattern=".+@gmail\.com"
                                        placeholder="Your Gmail Address" required>
                                     @if ($errors->has('email'))
                                    <span style="color: red;">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div>
                                <input type="number" name="NumberOfPerson" id="NumberOfPerson" class="form-control"
                                    placeholder="Number Of Person" required />
                                @if ($errors->has('NumberOfPerson'))
                                    <span style="color: red;">{{ $errors->first('NumberOfPerson') }}</span>
                                @endif
                            </div>

                            <div>
                                <input type="date" name="date" id="date" class="form-control" required />
                                @if ($errors->has('date'))
                                    <span style="color: red;">{{ $errors->first('date') }}</span>
                                @endif
                            </div>
                            <div>
                                <input type="time" name="booking_time" id="booking_time" class="form-control" required />
                                @if ($errors->has('booking_time'))
                                    <span style="color: red;">{{ $errors->first('booking_time') }}</span>
                                @endif
                            </div>
                            <div class="btn_box">
                                <button type="submit" id="submitButton">Book Now</button>
                            </div>

                            <script>
                                document.getElementById("BookForm").addEventListener("submit", function(event) {
                                    event.preventDefault();
                                    alert("Reservation Added Successfully!");
                                    this.submit();
                                });
                            </script>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- end book section -->

    <!-- client section -->

    <section class="client_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center psudo_white_primary mb_45">
                <h2 class="fw-bold text-dark">
                    ⭐ What Our Customers Say
                </h2>
                <p class="text-muted">
                    Real feedback from people who visited us
                </p>
            </div>

            <div class="carousel-wrap row">
                <div class="owl-carousel client_owl-carousel">

                    @forelse ($Reviews as $review)
                        <div class="item">
                            <div class="box shadow-sm rounded p-4 bg-white">
                                <div class="detail-box text-center">
                                    <p class="fst-italic text-secondary">
                                        "{{ $review->message }}"
                                    </p>

                                    <h6 class="mt-3 fw-semibold">
                                        {{ $review->name }}
                                    </h6>

                                    <p class="text-warning mb-2">
                                        {{-- Render stars dynamically --}}
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                ⭐
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </p>

                                    <small class="text-muted">
                                        {{ $review->email }}
                                    </small>
                                </div>
                                <div class="img-box"> <img src="images/client1.jpg" alt="" class="box-img">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="item">
                            <div class="box shadow-sm rounded p-4 bg-white text-center">
                                <p class="text-muted">No reviews yet. Be the first to share your experience!</p>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </section>


    <!-- end client section -->
@endsection
