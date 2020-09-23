@extends('layouts.backend')
@section('content')
    <h1>Gebruiker</h1>
    <a href="/backend/gebruiker">
        <button class="btn btn-outline-dark" type="button">Ga terug</button>
    </a>
    <hr>
    <h2>Wachtwoord wijzigen</h2>
    <form action="/backend/gebruiker/{{$user -> id}}/update" method="POST">
        @csrf
        @method('PUT')

        @if($errors->any())
            <p class="alert alert-danger"> Controleer input</p>
        @endif

        <div class="form-group row">
            <label for="passwoord" class="col-sm-2 col-form-label">Nieuw wachtwoord</label>
            <div class="col-sm-4">
                <input class="form-control form-control-sm @error('password') is-invalid @enderror" type="password"
                       name="password"
                       value="{{old('password')}}" autocomplete="off">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

        </div>
        <br>
        <div class="control">
            <button class="btn btn-outline-secondary" type="submit">Bewerken</button>
        </div>
    </form>
    <br>
@endsection
