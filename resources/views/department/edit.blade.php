@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <h1 class="text-black panel__welcome-header">
            Edycja działu {{ $department->name }} o id: {{ $department->id }}
        </h1>

        <form method="POST" enctype="multipart/form-data" action="/department/{{ $department->id }}" class="crud__form">
            @method('PUT')
            @csrf
        
            <div class="crud__attribute-wrapper">
                <label for="name" class="form-label crud__label">
                    Nazwa
                </label>
            
                <input type="text" name="name" id="name" value="{{ old('name', $department->name) }}"
                autocomplete="off" class="form-control crud__input @error('name') is-invalid crud__input--invalid @enderror"
                required>
            
                @error('name')
                <span class="invalid-feedback crud__error">
                Error: {{ $message }}
                </span>
                @enderror
            </div>

            <div class="crud__attribute-wrapper">
                <label for="description" class="form-label crud__label">
                  Opis
                </label>
              
                <textarea name="description" id="description" rows="10"
                  class="form-control crud__text-area @error('description') is-invalid crud__text-area--invalid @enderror"
                  required>{{ old('description', $department->description) }}</textarea>
              
                @error('description')
                <span class="invalid-feedback crud__error">
                  Error: {{ $message }}
                </span>
                @enderror
            </div>
            
            <button type="submit" class="button button__submit button__submit--edit">
                Edytuj dane działu
            </button>
        </form>

        <hr>

        <a href="{{ route('user.index') }}">Przejdź do listy pracowników</a>
        <a href="{{ route('department.index') }}">Przejdź do listy działów</a>
        <a href="{{ route('home.index') }}">Przejdź do panelu</a>

    </div>
@endsection
