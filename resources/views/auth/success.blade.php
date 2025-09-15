@extends('Shared_Layouts.Shared')

@section('Title') Register Success @endsection


@section('Content')
<div class="container text-center mt-5 mb-5">
    <h2 class="text-success">🎉 Thank You!</h2>
    <p>You Reistered successfully.</p>
    <a href="{{ route('home.index') }}" class="btn btn-primary mt-3"> HomePage</a>
</div>
@endsection