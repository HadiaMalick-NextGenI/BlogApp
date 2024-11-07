@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h1>{{ $blog->title }}</h1>
        <p class="lead">{{ $blog->content }}</p>

        <div class="mt-4">
            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning">{{__('Edit')}}</a>

            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">{{__('Delete')}}</button>
            </form>

            <a href="{{ route('blogs.index') }}" class="btn btn-secondary">{{__('Back to Blogs')}}</a>
        </div>
    </div>
@endsection
