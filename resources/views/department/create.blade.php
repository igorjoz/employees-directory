@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <h1 class="text-black panel__welcome-header">
            Tworzenie nowego działu
        </h1>

        <form method="POST" enctype="multipart/form-data" action="/department" class="crud__form">
            @method('POST')
            @csrf
        
            <div class="crud__attribute-wrapper">
                <label for="name" class="form-label crud__label">
                    Nazwa
                </label>
            
                <input type="text" name="name" id="name" value="{{ old('name') }}"
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
                  required>{{ old('description') }}</textarea>
              
                @error('description')
                <span class="invalid-feedback crud__error">
                  Error: {{ $message }}
                </span>
                @enderror
            </div>
            
            <button type="submit" class="button button__submit button__submit--create">
                Stwórz nowy dział
            </button>
        </form>

        <hr>

        <a href="{{ route('user.index') }}">Przejdź do listy pracowników</a>
        <a href="{{ route('department.index') }}">Przejdź do listy działów</a>
        <a href="{{ route('home.index') }}">Przejdź do panelu</a>

    </div>
@endsection
