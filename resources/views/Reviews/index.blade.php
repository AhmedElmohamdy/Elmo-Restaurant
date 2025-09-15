@extends('Shared_Layouts.Shared')

@section('Title')
    Customer Reviews
@endsection

@section('Content')
    <!-- review section -->
    <section class="review_section layout_padding py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="heading_container d-flex flex-column align-items-center text-center mb-5">
                <h2 class="display-5 fw-bold text-dark">Share Your Experience</h2>
                <p class="text-muted">We’d love to hear your feedback about our restaurant.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="form_container bg-white shadow-lg rounded p-4 p-md-5">
                        <form method="POST" id="ReviewForm" action="{{ route('reviews.store') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <input type="text" name="name" id="name" class="form-control"
                                       placeholder="Your Name" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="Your Email" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="phone" id="phone" class="form-control"
                                       placeholder="Your Phone Number" required>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <textarea name="review" id="review" rows="5" class="form-control"
                                          placeholder="Write your review..." required></textarea>
                                @error('review')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="rating" class="fw-semibold">Rating:</label>
                                <select name="rating" id="rating" class="form-control" required>
                                    <option value="">Select Rating</option>
                                    <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                    <option value="4">⭐⭐⭐⭐ Very Good</option>
                                    <option value="3">⭐⭐⭐ Good</option>
                                    <option value="2">⭐⭐ Fair</option>
                                    <option value="1">⭐ Poor</option>
                                </select>
                                @error('rating')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" id="submitButton"
                                        class="btn btn-primary px-4 py-2 rounded-pill">
                                    Submit Review
                                </button>
                            </div>

                            <script>
                                document.getElementById("ReviewForm").addEventListener("submit", function(event) {
                                    event.preventDefault();
                                    alert("Thank you for your feedback!");
                                    this.submit();
                                });
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
