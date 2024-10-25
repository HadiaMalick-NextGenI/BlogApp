@extends('layout.app')

@section('content')

    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h2 class="mt-5">Welcome {{ Auth::user()->name }}</h2>
        <div class="container">
            <h1>Profile</h1>
            <div class="profile">
                {{-- <img src="{{ url('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="img-fluid" /> --}}
                <img src="{{ asset('/storage/' . $user->profile_picture) }}" alt="Profile Picture" class="img-fluid w-25" />
                <h2>{{ $user->name }}</h2>
                <p>Email: {{ $user->email }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-7">
                <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
                <a href="{{ route('blogs.index') }}" class="btn btn-primary">Go to Blogs</a> 
            </div>
        </div>
    </div>
@endsection


{{-- <div class="row">
            <div class="col-7">
                <table class="table table-striped table-bordered">
                    @foreach ($users as $user)
                        <tr>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->email }} </td>
                            <td> {{ $user->phone }} </td>
                            <td> {{ $user->age }} </td>
                            <td> {{ $user->city }} </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div> --}}


 {{-- <div class="container mt-5">
        <h1 class="mb-4">Even Numbers</h1>
        <ul class="list-group mb-5">
            @foreach ($numbers as $number)
                @if ($number % 2 == 0)
                    <li class="list-group-item">{{ $number }}</li>
                @endif
            @endforeach
        </ul>

        <h1 class="mb-4">Users</h1>
        <ul class="list-group">
            @forelse ($users as $user)
                <li class="list-group-item">{{ $user->name }}</li>
            @empty
                <li class="list-group-item">No users</li>
            @endforelse
        </ul>
    </div> --}}
