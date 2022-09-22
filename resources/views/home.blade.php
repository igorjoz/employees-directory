@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">
            Zalogowano jako <b>{{ $user->name }}</b> o id: <b>{{ $user->id }}</b>
        </h1>

        <h2>
            Twoja rola to: <b>{{ $user->getRoleNames()[0] }}</b>
        </h2>
    </div>
@endsection
