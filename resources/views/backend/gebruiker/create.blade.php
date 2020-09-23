@extends('layouts.backend')
@section('content')
    <h1>Gebruiker</h1>
    <a href="/backend/gebruiker">
        <button class="btn btn-outline-dark" type="button">Ga terug</button>
    </a>
    <hr>
    <h2>Gebruiker toevoegen</h2>
    <form action="/backend/gebruiker" method="POST">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Gebruikers naam *</label>
            <div class="col-sm-4">
                <input class="form-control form-control-sm @error('name') is-invalid @enderror" type="text" name="name"
                       value="{{old('name')}}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email *</label>
            <div class="col-sm-4">
                <input class="form-control form-control-sm  @error('email') is-invalid @enderror" type="text"
                       name="email"
                       value="{{old('email')}}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

        </div>

        <div class="form-group row">
            <label for="passwoord" class="col-sm-2 col-form-label">Wachtwoord *</label>
            <div class="col-sm-4">
                <input class="form-control form-control-sm @error('password') is-invalid @enderror" type="password"
                       name="password"
                       value="{{old('password')}}">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="admin" class="col-sm-2 col-form-label">Heeft administrator rechten</label>

            <div class="col-sm-2 col-form-label4">
                <table>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="true"
                                       name="admin"
                                       value="true">
                                <label class="form-check-label" for="true">
                                    Ja
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="true"
                                       name="admin"
                                       value="false">
                                <label class="form-check-label" for="true">
                                    Nee
                                </label>
                            </div>
                        </td>
                    </tr>
                </table>
                @error('admin')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <br>
        <div class="control">
            <button class="btn btn-outline-secondary" type="submit">Toevoegen</button>
        </div>
    </form>
    <br>
    <p>* verplichte velden</p>
@endsection
