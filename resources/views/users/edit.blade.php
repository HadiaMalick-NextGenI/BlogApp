@extends('layout.app')

@section('content')
<h2 class="mt-3">{{__('Edit User Info')}}</h2>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- <div class="form-group">
            <label for="name">Role:</label>
            <select name="roles[]" class="form-control" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>         --}}

        @role('admin')
            <div class="form-group">
                <label for="name">{{__('Role:')}}</label>
                <select name="roles[]" class="form-control" multiple>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" 
                            @if (in_array($role->name, $userRoles)) selected @endif>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div> 
        @endrole 

        <div class="form-group">
            <label for="name">{{__('Name')}}</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name' , $user->name)}}" required>
            <span class="text-danger">
                @error('name')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group">
            <label for="email">{{__('Email:')}}</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" required>
            <span class="text-danger">
                @error('email')
                    {{ $message }}
                @enderror
            </span>
        </div>
        {{-- <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" value="{{ old('password', $user->password) }}" required>
            <span class="text-danger">
                @error('password')
                    {{ $message }}
                @enderror
            </span>
        </div> --}}
        <div class="form-group">
            <label for="phone">{{__('Phone:')}}</label>
            <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
            <span class="text-danger">
                @error('phone')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group">
            <label for="dob">{{__('Date of Birth:')}}</label>
            <input type="date" class="form-control" name="dob" id="dob" value="{{ old('dob', $user->dob) }}">
            <span class="text-danger">
                @error('dob')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group">
            <label for="age">{{__('Age:')}}</label>
            <input type="number" class="form-control" name="age" id="age" value="{{ old('age', $user->age) }}">
            <span class="text-danger">
                @error('age')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group">
            <label for="city">{{__('City:')}}</label>
            <input type="text" class="form-control" name="city" id="city" value="{{ old('city', $user->city) }}">
            <span class="text-danger">
                @error('city')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group">
            <label for="city">{{__('Profile Picture:')}}</label>
            <img src="{{ asset('/storage/' . $user->profile_picture) }}" alt="Profile Picture" class="img-fluid w-25" />
            <input type="file" class="form-control" name="profile_picture" id="profile_picture" accept="jpeg,png,jpg"> 
            {{-- value="{{ old('profile_picture', $user->profile_picture) }}" --}}
            <span class="text-danger">
                @error('profile_picture')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">{{__('Cancel')}}</a>
    </form>
@endsection