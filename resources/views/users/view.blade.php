@extends('layout.app')

@section('content')
    <div class="container mt-3">
        <img src="{{ $user->profile_picture ? asset('/storage/' . $user->profile_picture) : asset('storage/profile_pictures/YOqlmkCpNiwvAdshF6MusvLP38S49tMisTW5mF9q.png') }}" 
            alt="Profile Picture" class="img-fluid w-25" />
        <h1>{{ $user->name }}</h1>
        <p class="lead">@lang('Email'): {{ $user->email }}</p>
        <p class="lead">{{__('Phone')}} {{ $user->phone }}</p>
        <p class="lead">{{__('Age')}} {{ $user->age }}</p>
        <p class="lead">{{__('DOB')}} {{ $user->dob ?? "NULL" }}</p>
        <p class="lead">{{__('City')}} {{ $user->city }}</p>
        <h3>{{__('Blogs')}}</h3>
        @if($user->blogs->isEmpty())
            <p>{{__('No blogs found for this user.')}}</p>
        @else
            <ul>
                @foreach($user->blogs as $blog)
                    <li>
                        <a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
        <div class="mt-4">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">{{__('Edit')}}</a>

            @role('admin')
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">{{__('Delete')}}</button>
                </form>
            @endrole
            <a href="{{ route('users.index') }}" class="btn btn-secondary">{{__('Back to Users')}}</a>
        </div>
    </div>
@endsection
