@extends('layout.app')

@section('content')
    <div class="container">
        <h3>{{ $subject}}</h3>
        <p>{{ $mailMessage}}</p>
        <p>{{ $details['product']}}</p>
        <p>{{ $details['price']}}</p>
    </div>
@endsection