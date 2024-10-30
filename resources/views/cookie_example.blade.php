@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Cookie Example</h1>
        @if($language)
            <p>Your preferred language is: {{ $language }}</p>
        @else
            <p>No preferred language set.</p>
        @endif

        <form action="{{ route('set-cookie') }}" method="POST">
            @csrf
            <label for="language">Set your preferred language:</label>
            <input type="text" name="language" id="language" required>
            <button type="submit">Set Language</button>
        </form>
    </div>
@endsection