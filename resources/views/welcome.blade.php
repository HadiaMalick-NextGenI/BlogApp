@extends('layout.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="text-center">
            @if (Route::has('login'))
                <div class="mb-4">
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-primary">{{__('Home')}}</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary mr-2">{{ __('Login') }}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('signup') }}" class="btn btn-outline-secondary">{{ __('Register') }}</a>
                        @endif
                    @endauth
                </div>
            @endif

            <h1 class="display-4 mb-3">{{ __('Welcome to Laravel') }}</h1>

            <div class="d-flex justify-content-center flex-wrap">
                <a href="https://laravel.com/docs" class="btn btn-link">Docs</a>
                <a href="https://laracasts.com" class="btn btn-link">Laracasts</a>
                <a href="https://laravel-news.com" class="btn btn-link">News</a>
                <a href="https://blog.laravel.com" class="btn btn-link">Blog</a>
                <a href="https://nova.laravel.com" class="btn btn-link">Nova</a>
                <a href="https://forge.laravel.com" class="btn btn-link">Forge</a>
                <a href="https://vapor.laravel.com" class="btn btn-link">Vapor</a>
                <a href="https://github.com/laravel/laravel" class="btn btn-link">GitHub</a>
            </div>

            @include('partials.language_switcher')
        </div>
    </div>
@endsection
