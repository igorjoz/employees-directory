@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <div class="crud__info-wrapper">
            <h1 class="text-black panel__welcome-header">
                Profil działu {{ $department->name }}
            </h1>

            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('department.edit', $department->id) }}" class="crud__button">
                    Edytuj
                </a>
    
                <form method="post" action="/department/{{ $department->id }}">
                    @method('DELETE')
                    @csrf
                    
                    <button class="button button__submit button__submit--delete">
                        Usuń
                    </button>
                </form>
            @endif
        </div>
        

        <h2>
            Ilość pracowników działu: {{ $department->users->count() }}
        </h2>

        <h2>
            Pracownicy działu:
            @foreach($departmentUsers as $user)
            <a href="{{ route('user.show', $user->id) }}">
                {{ $user->name . " " . $user->surname }};
            </a>
            @endforeach
        </h2>

        <h2>
            Opis działu
        </h2>
        <p>
            {{ $department->description }}
        </p>

        <a href="{{ route('user.index') }}">Przejdź do listy pracowników</a>
        <a href="{{ route('department.index') }}">Przejdź do listy działów</a>
        <a href="{{ route('home.index') }}">Przejdź do panelu</a>

    </div>
@endsection
