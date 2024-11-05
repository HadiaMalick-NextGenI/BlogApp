@extends('layout.base_error')

@section('title', 'Access Denied')

@section('content')
    <h1>403 - Access Denied</h1>
    <p>You don't have permission to access this page.</p>
    <a href="{{ url('/home') }}" class="btn btn-primary">Return to Homepage</a>
@endsection