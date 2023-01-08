@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <h1 class="text-black panel__welcome-header">
            Lista działów
        </h1>

        <form class="form-inline" method="GET">
            <div class="form-group mb-2">
            <input type="text" class="form-control" id="filter" name="filter" placeholder="Nazwa działu" value="{{$filter}}">
            </div>
            <button type="submit" class="btn btn-default mb-2">Wyszukaj</button>
        </form>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col" class="table__header">@sortablelink('id', 'ID')</th>
                    <th scope="col" class="table__header">@sortablelink('name', 'Nazwa')</th>
                    <th scope="col" class="table__header">Opis</th>
                    <th scope="col" class="table__header">Ilość pracowników</th>
                    <th scope="col" class="table__header">Pracownicy działu</th>
                    <th scope="col" class="table__header">@sortablelink('created_at', 'Data stworzenia')</th>
                    <th scope="col" class="table__header">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @if ($departments->count() == 0)
                <tr>
                    <td colspan="5">Brak departamentów do wyświetlenia</td>
                </tr>
                @endif

                @forelse ($departments as $department)
                <tr>
                    <th scope="row" class="table__cell">
                        {{ $department->id }}
                    </th>
    
                    <td class="table__cell table__cell--important">
                        <a href="{{ route('department.show', $department->id) }}">
                            {{ $department->name }}
                        </a>
                    </td>

                    <td class="table__cell table__cell--important">
                        {{ $department->description }}
                    </td>

                    <td class="table__cell table__cell--important">
                        {{ $department->users_count }}
                    </td>

                    <td class="table__cell table__cell--important">
                        @foreach($department->users as $user)
                        <a href="{{ route('user.show', $user->id) }}">
                            {{ $user->name }} {{ $user->surname }};
                        </a>
                        @endforeach
                        <br>
                    </td>
    
                    <td class="table__cell">
                        {{ $department->created_at->format('Y-m-d') }}
                    </td>
    
                    <td class="table__cell">
                        <div class="table__actions-wrapper">
                            @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('department.edit', $department->id) }}">
                            Edytuj
                            </a>

                            <form method="post" action="{{ route('department.destroy', $department->id) }}">
                                @method('DELETE')
                                @csrf
                                
                                <button class="button button__submit button__submit--delete button__submit--small">
                                    Usuń
                                </button>
                            </form>
                            @else
                            <a href="{{ route('department.show', $department->id) }}">
                            Podgląd
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>

        {{ $departments->withQueryString()->links() }}

    </div>
@endsection
