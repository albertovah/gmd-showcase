@extends('layouts.backend')
@section('content')
    <h1>Categorieën</h1>
    <a href="/home"><button type="button" class="btn btn-outline-dark">Ga terug</button></a>
    <a href="/backend/categorie/create"><button type="button" class="btn btn-outline-dark">Nieuwe categorie toevoegen</button></a>
    <hr>
    <h2>Overview categorieën</h2>
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Categorie naam</th>
            <th scope="col">Datum aangemaakt</th>
            <th scope="col">Datum geupdate</th>
            <th></th>
        </tr>
        </thead>
        @foreach($categories as $categorie)
            <tr>
                <th scope="row">{{$categorie -> id}}</th>
                <td>{{$categorie -> categorie_naam}}</td>
                <td>{{$categorie -> created_at}}</td>
                <td>{{$categorie -> updated_at}}</td>
                <td>
                    <a onclick="return confirm('Weet je zeker dat je deze categorie wilt verwijderen?')" href="/backend/categorie/{{$categorie -> id}}/delete"> <button type="button" class="btn btn-outline-danger">Verwijderen</button></a>
                    <a href="/backend/categorie/{{$categorie -> id}}/edit"><button type="button" class="btn btn-outline-primary">Bewerken</button></a>
                </td>
            </tr>
        @endforeach
    </table>
    @if(isset($error))
        <p class="alert-danger">{{$error}}</p>
    @endif
@endsection
