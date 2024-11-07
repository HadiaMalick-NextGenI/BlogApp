@extends('layout.app')

@section('content')
    <h1 class="my-4">{{__('Blog Posts')}}</h1>

    <a href="{{ route('blogs.create') }}" class="btn btn-success mb-3">{{__('Create New Post')}}</a>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($blogs->isEmpty())
        <div class="alert alert-warning" role="alert">
            {{__('No posts found.')}}
        </div>
    @else
        <div>
            <a href="{{ route('blogs.index', ['filter' => 'published']) }}" 
            class="btn {{ $filter === 'published' ? 'btn-primary' : 'btn-outline-primary' }}">
            {{__('Published')}}
            </a>
            <a href="{{ route('blogs.index', ['filter' => 'draft']) }}" 
            class="btn {{ $filter === 'draft' ? 'btn-secondary' : 'btn-outline-secondary' }}">
            {{__('Drafts')}}
            </a>
        </div>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{__('ID')}}</th>
                    <th>{{__('Title')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>
                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info">{{__('View')}}</a>
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning">{{__('Edit')}}</a>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">{{__('Delete')}}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
