@extends('layout.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1 class="my-4">Create New Blog Post</h1>

    <form action="{{ route('blogs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" placeholder="Enter content" required {{ old('content') }}></textarea>
        </div>

        <input type="hidden" name="status" id="status" value="draft"> 
        
        <button type="submit" class="btn btn-primary" 
            onclick="document.getElementById('status').value='published'">Publish Post</button>

        <button type="submit" class="btn btn-warning" 
            onclick="document.getElementById('status').value='draft'">Save as Draft</button>

        <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

@endsection
