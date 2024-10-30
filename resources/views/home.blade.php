@extends('layout.app')

@section('content')

<div class="container">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="profile text-center mt-4">
        <h1>Profile</h1>
        <img src="{{ $user->profile_picture ? asset('/storage/' . $user->profile_picture) : asset('storage/profile_pictures/YOqlmkCpNiwvAdshF6MusvLP38S49tMisTW5mF9q.png') }}" 
             alt="Profile Picture" class="img-fluid rounded-circle w-25" />
        <h2 class="mt-3">{{ $user->name }}</h2>
        <p>Email: {{ $user->email }}</p>
        <p class="mt-3">
            <a href="{{ route('profile.edit') }}" class="btn btn-warning">Edit Profile</a>
        </p>
    </div>
    
    <div class="row mt-5">
        <div class="col-12 text-center">
            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
            @hasrole('editor|admin')
                <a href="{{ route('users.index') }}" class="btn btn-primary">Go to Users</a>
            @else
                <a href="{{ route('blogs.index') }}" class="btn btn-primary">Go to Blogs</a>
            @endhasrole
        </div>
    </div>
</div>

@endsection