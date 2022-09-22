@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        
        <h1 class="text-black panel__welcome-header">
            Lista użytkowników
        </h1>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col" class="table__header">ID</th>
                    <th scope="col" class="table__header">Imię</th>
                    <th scope="col" class="table__header">Nazwisko</th>
                    <th scope="col" class="table__header">Email</th>
                    <th scope="col" class="table__header">Numer telefonu</th>
                    <th scope="col" class="table__header">Opis</th>
                    <th scope="col" class="table__header">Rola</th>
                    <th scope="col" class="table__header">Ilość działów</th>
                    <th scope="col" class="table__header">Działy</th>
                    <th scope="col" class="table__header">Data stworzenia</th>
                    <th scope="col" class="table__header">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <th scope="row" class="table__cell">
                        {{ $user->id }}
                    </th>
    
                    <td class="table__cell table__cell--important">
                        {{ $user->name }}
                    </td>

                    <td class="table__cell table__cell--important">
                        {{ $user->surname }}
                    </td>
    
                    <td class="table__cell table__cell--important">
                        <a href="{{ route('user.show', $user->id) }}">
                            {{ $user->email }}
                        </a>
                    </td>

                    <td class="table__cell table__cell--important">
                        {{ $user->phone_number }}
                    </td>

                    <td class="table__cell table__cell--important">
                        {{ $user->description }}
                    </td>

                    <td class="table__cell">
                        {{ $user->getRoleNames()[0] }}
                    </td>

                    <td class="table__cell">
                        {{ $user->departments_count }}
                    </td>

                    <td class="table__cell">
                        @foreach($user->departments as $department)
                        <a href="{{ route('department.show', $department->id) }}">
                            {{ $department->name }};
                        </a>
                        <br>
                        @endforeach
                    </td>

                    <td class="table__cell">
                        {{ $user->created_at->format('Y-m-d') }}
                    </td>
    
                    <td class="table__cell">
                        <div class="table__actions-wrapper">
                            akcje
                            {{-- @listActionShow(array_merge($defaultDataArray, ['id' => $brand->id, 'object' => $brand]))
                            @endlistActionShow
    
                            @listActionEdit(array_merge($defaultDataArray, ['id' => $brand->id]))
                            @endlistActionEdit
    
    
                            @listActionDelete(array_merge($defaultDataArray, ['id' => $brand->id]))
                            @endlistActionDelete --}}
                        </div>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>

    </div>
@endsection
