@extends('layout.app')

@section('content')
<div class="container">
    <h1>{{__('Edit Blog Post')}}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">{{__('Title')}}</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
        </div>

        <div class="form-group">
            <label for="content">{{__('Content')}}</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $blog->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary">{{__('Cancel')}}</a>
    </form>
</div>
@endsection
