@extends('layout.base_error')

@section('title', 'Page Not Found')

@section('content')
    <h1>404 - Page Not Found</h1>
    <p>The page you are looking for might have been removed or is temporarily unavailable.</p>
    <a href="{{ url('/home') }}" class="btn btn-primary">Go to Homepage</a>
@endsection
