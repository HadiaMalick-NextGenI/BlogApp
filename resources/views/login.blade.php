@extends('layout.app')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="mt-5">{{ $data?? "Login" }}</h2>
    <form method="POST" action="/login">
        @csrf
        @include('partials.form')
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection
