@extends('layout.app')

@section('content')
    <div class="container mt-3">
        <img src="{{ asset('/storage/' . $user->profile_picture) }}" alt="Profile Picture" class="img-fluid w-25" />
        <h1>{{ $user->name }}</h1>
        <p class="lead">Email: {{ $user->email }}</p>
        <p class="lead">Phone: {{ $user->phone }}</p>
        <p class="lead">Age: {{ $user->age }}</p>
        <p class="lead">DOB: {{ $user->dob ?? "NULL" }}</p>
        <p class="lead">City: {{ $user->city }}</p>
        <div class="mt-4">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>

            @role('admin')
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                </form>
            @endrole
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
        </div>
    </div>
@endsection
