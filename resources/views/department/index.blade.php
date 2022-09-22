@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        
        <h1 class="text-black panel__welcome-header">
            Lista działów
        </h1>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col" class="table__header">ID</th>
                    <th scope="col" class="table__header">Nazwa</th>
                    <th scope="col" class="table__header">Opis</th>
                    <th scope="col" class="table__header">Data stworzenia</th>
                    <th scope="col" class="table__header">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($departments as $department)
                <tr>
                    <th scope="row" class="table__cell">
                        {{ $department->id }}
                    </th>
    
                    <td class="table__cell table__cell--important">
                        {{ $department->name }}
                    </td>

                    <td class="table__cell table__cell--important">
                        {{ $department->description }}
                    </td>
    
                    <td class="table__cell">
                        {{ $department->created_at->format('Y-m-d') }}
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
