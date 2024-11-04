@extends('layout.app')

@section('content')
    <h1>Notifications</h1>

    @if ($notifications->isEmpty())
        <p>No notifications</p>
    @else
        <ul>
            @foreach ($notifications as $notification)
                <li>
                    {{ $notification->data['message'] }}
                    <a href="{{ $notification->data['url'] }}">View Blog</a>

                    @if (!$notification->read_at)
                        <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Mark as Read</button>
                        </form>
                    @else
                        <span>(Read)</span>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
@endsection
