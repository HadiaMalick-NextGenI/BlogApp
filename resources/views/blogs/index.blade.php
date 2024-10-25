@extends('layout.app')

@section('content')
    <h1 class="my-4">Blog Posts</h1>

    <a href="{{ route('blogs.create') }}" class="btn btn-success mb-3">Create New Post</a>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endif

    @if ($blogs->isEmpty())
        <div class="alert alert-warning" role="alert">
            No posts found.
        </div>
    @else
        <div>
            <a href="{{ route('blogs.index', ['filter' => 'published']) }}" 
            class="btn {{ $filter === 'published' ? 'btn-primary' : 'btn-outline-primary' }}">
            Published
            </a>
            <a href="{{ route('blogs.index', ['filter' => 'draft']) }}" 
            class="btn {{ $filter === 'draft' ? 'btn-secondary' : 'btn-outline-secondary' }}">
            Drafts
            </a>
        </div>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>
                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
