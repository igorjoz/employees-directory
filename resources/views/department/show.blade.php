@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        
        <h1 class="text-black panel__welcome-header">
            Profil działu {{ $department->name }}
        </h1>

        <h2>
            Ilość pracowników działu: {{ $department->users->count() }}
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
