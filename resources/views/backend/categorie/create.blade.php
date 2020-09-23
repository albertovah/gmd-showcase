@extends('layouts.backend')
@section('content')
    <h1>Categorieën</h1>
    <a href="/backend/categorie"><button  class="btn btn-outline-dark" type="button">Ga terug</button></a>    <hr>
    <h2>Categorie toevoegen</h2>
    <form action="/backend/categorie" method="POST">
        @csrf
        <div class="form-group row">
            <label for="categorie_naam" class="col-sm-2  col-form-label">Categorie naam</label>
           <div class="col-md-4">
               <input class="form-control @error('categorie_naam') is-invalid @enderror" type="text" name="categorie_naam" value="{{ old('categorie_naam') }}">
               @error('categorie_naam')
               <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
               @enderror
           </div>
        </div>
        <br>
        <div class="form-group">
            <button class="btn btn-outline-secondary" type="submit">Toevoegen</button>
        </div>
    </form>
@endsection

