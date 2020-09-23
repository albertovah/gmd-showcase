@extends('layouts.backend')
@section('content')
    <h1>Modules</h1>
    <a href="/backend/module">
        <button class="btn btn-outline-dark" type="button">Ga terug</button>
    </a>
    <hr>
    <h2>Module toevoegen</h2>
    <form method="POST" action="/backend/module">
        @csrf

        @if($errors->any())
            <p class="alert alert-danger"> Controleer input</p>
        @endif

        <div class="form-group row">
            <label for="module_naam" class="col-sm-2  col-form-label">Module naam</label>
            <div class="col-md-4">
                <input class="form-control form-control-sm @error('module_naam') is-invalid @enderror" type="text" name="module_naam"
                       value="{{ old('module_naam') }}">
                @error('module_naam')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="control">
            <button class="btn btn-outline-secondary" type="submit">Toevoegen</button>
        </div>
    </form>
    <br>
@endsection
