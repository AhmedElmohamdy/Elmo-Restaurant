@extends('Shared_Layouts.Shared')

@section('Title')
    Reservation Booking
@endsection

@section('Content')
    <section class="book_section layout_padding py-5" style="background-color:#f8f9fa;">
        <div class="container">

            <div class="heading_container text-center mb-5">
                <h2 class="display-5 fw-bold text-dark">Book A Table</h2>
                <p class="text-muted">Reserve your table in just a few seconds.</p>
                <p class="text-muted">Check Your Email for Confirmation</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">

                    <div class="form_container bg-white shadow-lg rounded p-4 p-md-5">



                            <form method="POST" id="BookForm" action="{{ route('home.saveBooking') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name"
                                         required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" name="phoneNumber" class="form-control" placeholder="Phone Number"
                                        required>
                                    @error('phoneNumber')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <input type="email" name="email" class="form-control"
                                        pattern=".+@gmail\.com"
                                        placeholder="Your Gmail Address" required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <input type="number" name="NumberOfPerson" class="form-control"
                                        placeholder="Number Of Persons" min="1" required>
                                    @error('NumberOfPerson')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 mb-3">
                                        <input type="date" name="date" class="form-control" min="{{ date('Y-m-d') }}"
                                            required>
                                        @error('date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <input type="time" name="booking_time" class="form-control" required>
                                        @error('booking_time')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                <div class="text-center mt-3">
                                    <button type="submit" id="submitButton" class="btn btn-primary px-4 py-2 rounded-pill">
                                        Book Now
                                    </button>
                                </div>

                            </form>



                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


<script>
    document.getElementById("BookForm")?.addEventListener("submit", function() {

        let button = document.getElementById("submitButton");

        button.disabled = true;
        button.innerText = "Booking...";

    });
</script>
