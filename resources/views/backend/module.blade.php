@extends('layouts.backend')
@section('content')
    <h1>Modules</h1>
    <a href="/home">
        <button type="button" class="btn btn-outline-dark">Ga terug</button>
    </a>
    <a href="/backend/module/create">
        <button type="button" class="btn btn-outline-dark">Nieuwe module toevoegen</button>
    </a>
    <hr>
    <h2>Overview modules</h2>
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Module naam</th>
            <th scope="col">Datum aangemaakt</th>
            <th scope="col">Datum geupdate</th>
            <th></th>
        </tr>
        </thead>
        @foreach($modules as $module)
            <tr>
                <th scope="row">{{$module -> id}}</th>
                <td>{{$module -> module_naam}}</td>
                <td>{{$module -> created_at}}</td>
                <td>{{$module -> updated_at}}</td>
                <td>
                    <a onclick="return confirm('Weet je zeker dat je deze module wilt verwijderen?')"
                       href="/backend/module/{{$module ->id}}/delete">
                        <button type="button" class="btn btn-outline-danger">Verwijderen</button>
                    </a>
                    <a href="/backend/module/{{$module -> id}}/edit">
                        <button type="button" class="btn btn-outline-primary">Bewerken</button>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <br>
    @if(isset($error))
        <p class="alert-danger">{{$error}}</p>
    @endif
@endsection
