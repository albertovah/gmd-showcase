@extends('layouts.backend')
@section('content')
    <h1>Categorieën</h1>
    <a href="/backend/categorie">
        <button class="btn btn-outline-dark" type="button">Ga terug</button>
    </a>
    <hr>
    <h2>Categorie bewerken</h2>
    <form action="/backend/categorie/{{$categorie -> id}}/update" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="categorie_naam" class="col-sm-2  col-form-label"> Categorie naam</label>
            <div class="col-md-4">
                <input class="form-control form-control-sm @error('categorie_naam') is-invalid @enderror" type="text" name="categorie_naam"
                       value="{{ old('categorie_naam') ? old('categorie_naam') : $categorie -> categorie_naam}}">
                @error('categorie_naam')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="control">
            <button class="btn btn-outline-secondary" type="submit">Bewerken</button>
        </div>
    </form>
@endsection
