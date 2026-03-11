@extends('Shared_Layouts.Shared')

@section('Title')
    Customer Reviews
@endsection

@section('Content')
    <section class="review_section layout_padding py-5" style="background:#f8f9fa;">
        <div class="container">

            <div class="heading_container text-center mb-5">
                <h2 class="display-5 fw-bold">Share Your Experience</h2>
                <p class="text-muted">Your feedback helps us improve our service.</p>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card shadow border-0 rounded-4 p-4">

                        <form method="POST" action="{{ route('reviews.store') }}" id="ReviewForm">
                            @csrf

                            {{-- Name --}}
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="mb-3">
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                                    required>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Review --}}
                            <div class="mb-3">
                                <textarea name="review" rows="5" class="form-control" placeholder="Write your experience with our restaurant..."
                                    required></textarea>

                                @error('review')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Rating --}}
                            <div class="mb-4">

                            <select name="rating" id="rating" class="form-control" required>
                                <option value="">Select Rating</option>
                                <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                <option value="4">⭐⭐⭐⭐ Very Good</option>
                                <option value="3">⭐⭐⭐ Good</option>
                                <option value="2">⭐⭐ Fair</option>
                                <option value="1">⭐ Poor</option>
                            </select> @error('rating')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    {{-- Submit --}}
                    <div class="text-center">
                        <button type="submit" id="submitBtn" class="btn btn-primary px-5 py-2 rounded-pill">
                            Submit Review
                        </button>
                    </div>

                    </form>

                </div>
            </div>
        </div>
        </div>
    </section>


    <style>
        .rating {
            direction: rtl;
            font-size: 28px;
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            color: #ddd;
        }

        .rating input:checked~label,
        .rating label:hover,
        .rating label:hover~label {
            color: #ffc107;
        }
    </style>

    <script>
        document.getElementById("ReviewForm").addEventListener("submit", function() {

            let btn = document.getElementById("submitBtn");

            btn.innerHTML = "Submitting...";
            btn.disabled = true;

        });
    </script>
@endsection
