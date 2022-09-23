@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <h1 class="text-black panel__welcome-header">
            Zalogowano jako 
            <img src="{{ Storage::url($user->image_path) }}" class="panel__user-image" alt="user image">
                <a href="{{ route('user.show', $user->id) }}">
                    <b>{{ $user->name }} {{ $user->surname }}</b>
                </a>
            o id: <b>{{ $user->id }}</b>
        </h1>

        <h2 class="panel__role-header">
            Twoja rola to: <b>{{ $user->getRoleNames()[0] }}</b>
        </h2>

        <h2>
            <a href="{{ route('user.edit_account') }}">
                Edytuj swoje dane
            </a>
        </h2>

        @if (Auth::user()->hasRole('admin'))
        <h2>
            <a href="{{ route('user.create') }}">
                Stwórz nowego użytkownika
            </a>
        </h2>

        <h2>
            <a href="{{ route('department.create') }}">
                Stwórz nowy dział
            </a>
        </h2>
        @endif

    </div>
@endsection
