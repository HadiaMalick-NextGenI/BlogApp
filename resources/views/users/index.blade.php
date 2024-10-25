@extends('layout.app')

@section('content')
    <h1 class="my-4">Users</h1>

    @role('admin')
        <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Create New User</a>
    @endrole
    
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($users->isEmpty())
        <div class="alert alert-warning" role="alert">
            No posts found.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            {{-- editor can view or edit, delete button should only be visible to admin --}}
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">View</a> 
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                            @role('admin')
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endrole
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
