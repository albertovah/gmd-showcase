@extends('layouts.backend')
@section('content')
    <h1>Gebruikers</h1>
    <a href="/home">
        <button type="button" class="btn btn-outline-dark">Ga terug</button>
    </a>
    <a href="/backend/gebruiker/create">
        <button type="button" class="btn btn-outline-dark">Nieuwe gebruiker toevoegen</button>
    </a>
    <hr>
    <h2>Overview gebruikers</h2>
    <table class="table table sm">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Naam</th>
            <th scope="col">Email</th>
            <th scope="col">Wachtwoord</th>
            <th scope="col">Is admin</th>
            <th></th>
        </tr>
        </thead>
        @foreach($gebruikers as $gebruiker)
            <tr>
                <th scope="row">{{$gebruiker -> id}}</th>
                <td>{{$gebruiker -> name}}</td>
                <td>{{$gebruiker -> email}}</td>
                <td>
                    <a href="/backend/gebruiker/{{$gebruiker ->id}}/edit"><button type="button" class="btn btn-outline-secondary">Wijzigen</button>
                    </a>
                </td>
                <td>@if($gebruiker-> admin =="1")
                        <form method="POST" Action="/backend/gebruiker/{{$gebruiker -> id}}/updateAdminTrue">
                           @csrf
                            @method('PUT')
                            <button class="btn btn-success" disabled >Ja</button>
                            <button class="btn btn-outline-danger" >nee</button>
                        </form>
                    @else
                        <form method="POST" Action="/backend/gebruiker/{{$gebruiker -> id}}/updateAdminFalse">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-outline-success" >Ja</button>
                            <button class="btn btn-danger" disabled>nee</button>
                        </form>

                    @endif
                </td>
                <td>
                    <a onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')"
                       href="/backend/gebruiker/{{$gebruiker ->id}}/delete">
                        <button type="button" class="btn btn-outline-danger">Verwijderen</button>
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
