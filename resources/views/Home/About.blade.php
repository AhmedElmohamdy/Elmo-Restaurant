@extends('Shared_Layouts.Shared')

@section('Title')
    About Us
@endsection


@section('Content')
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
                            <div class="btn-box">
                                <a href="{{ route('home.index') }}" class="btn-1">
                                    Home
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>

    </section>
@endsection
