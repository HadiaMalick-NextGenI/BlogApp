@extends('layout.base_error')

@section('title', 'Server Error')

@section('content')
    <h1>500 - Server Error</h1>
    <p>Something went wrong on our end. Please try again later.</p>
    <a href="{{ url('/home') }}" class="btn btn-primary">Return to Homepage</a>
@endsection
