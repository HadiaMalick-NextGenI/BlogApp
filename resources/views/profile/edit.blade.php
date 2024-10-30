@extends('layout.app')

@section('content')
<div class="container">
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

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2 class="mt-3">Edit Profile</h2>
    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="phone" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
        </div>

        <div class="form-group">
            <label for="dob">DOB</label>
            <input type="dob" class="form-control" id="dob" name="dob" value="{{ old('dob', $user->dob) }}">
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="age" class="form-control" id="age" name="age" value="{{ old('age', $user->age) }}">
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="city" class="form-control" id="city" name="city" value="{{ old('city', $user->city) }}">
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <img src="{{ $user->profile_picture ? asset('/storage/' . $user->profile_picture) : asset('storage/profile_pictures/YOqlmkCpNiwvAdshF6MusvLP38S49tMisTW5mF9q.png') }}" 
                alt="Profile Picture" class="img-fluid rounded-circle w-25" />
            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="jpeg,png,jpg">
        </div>

        <button type="submit" class="btn btn-success">Update Profile</button>
    </form>
</div>
@endsection
