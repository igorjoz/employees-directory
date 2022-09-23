@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <h1 class="text-black panel__welcome-header">
            Tworzenie nowego konta użytkownika
        </h1>

        <form method="POST" enctype="multipart/form-data" action="/user" class="crud__form">
            @method('POST')
            @csrf
        
            <div class="crud__attribute-wrapper">
                <label for="name" class="form-label crud__label">
                    Imię
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
                <label for="surname" class="form-label crud__label">
                    Nazwisko
                </label>
        
                <input type="text" name="surname" id="surname" value="{{ old('surname') }}"
                autocomplete="off" class="form-control crud__input @error('surname') is-invalid crud__input--invalid @enderror"
                required>
            
                @error('surname')
                <span class="invalid-feedback crud__error">
                Error: {{ $message }}
                </span>
                @enderror
            </div>

            <div class="crud__attribute-wrapper">
                <label for="password" class="form-label crud__label">
                  Hasło
                </label>
              
                <input type="password" name="password" id="password" value="{{ old('password') }}" autocomplete="off" class="form-control crud__input @error('password') is-invalid crud__input--invalid @enderror" required>
              
                @error('password')
                <span class="invalid-feedback crud__error">
                  Error: {{ $message }}
                </span>
                @enderror
            </div>

            <div class="crud__attribute-wrapper">
                <label for="image" class="form-label crud__label">
                    Zdjęcie profilowe
                </label>
              
                <input type="file" name="image" id="image"
                  class="form-control crud__input @error('image') is-invalid crud__input--invalid @enderror" accept="image/*">
              
                @error('image')
                <span class="invalid-feedback crud__error">
                  Error: {{ $message }}
                </span>
                @enderror
            </div>

            <div class="crud__attribute-wrapper">
                <label for="email" class="form-label crud__label">
                  E-mail
                </label>
              
                <input type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="off" class="form-control crud__input @error('email') is-invalid crud__input--invalid @enderror" required>
              
                @error('email')
                <span class="invalid-feedback crud__error">
                  Error: {{ $message }}
                </span>
                @enderror
            </div>

            <div class="crud__attribute-wrapper crud__attribute-wrapper--order">
                <label for="phone_number" class="form-label crud__label">
                    Numer telefonu
                </label>
    
                <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" autocomplete="off" class="form-control crud__input @error('phone_number') is-invalid crud__input--invalid @enderror"
                    required>
    
                @error('phone_number')
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
                Stwórz nowe konto użytkownika
            </button>
        </form>

        <hr>

        <a href="{{ route('user.index') }}">Przejdź do listy pracowników</a>
        <a href="{{ route('department.index') }}">Przejdź do listy działów</a>
        <a href="{{ route('home.index') }}">Przejdź do panelu</a>

    </div>
@endsection
