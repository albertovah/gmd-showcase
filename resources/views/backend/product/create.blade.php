@extends('layouts.backend')
@section('content')
    <h1>Producten</h1>
    <a href="/backend/product">
        <button class="btn btn-outline-dark" type="button">Ga terug</button>
    </a>
    <hr>
    <h2>Product toevoegen</h2>
    <form  method="POST" action="/backend/product/save" enctype="multipart/form-data" role="form">
        @csrf
        @if($errors->any())
            <p class="alert alert-danger"> Controleer input</p>
        @endif
        {{--titel--}}
        <div class="form-group row">
            <label class="col-sm-2  col-form-label">Titel *</label>
            <div class="col-sm-6">
                <input class="form-control @error('titel') is-invalid @enderror" type="text" name="titel"
                       value="{{ old('titel') }}">
                @error('titel')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{--omschrijving--}}
        <div class="form-group row">
            <label class="col-sm-2  col-form-label ">Omschrijving *</label>
            <div class="col-sm-10">
                <textarea style="height: 500px" class="form-control @error('omschrijving') is-invalid @enderror"
                          type="text"
                          name="omschrijving">{{ old('omschrijving') }}</textarea>
                @error('omschrijving')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{--afbeelding invoeren--}}
        <div class="form-group row">
            <label for="afbeelding" class="col-sm-2 col-form-label">Afbeelding</label>
            <div class="col-sm-6">
                <input class="form-control btn-info  @error('afbeelding') is-invalid @enderror" id="afbeelding"
                       type="file" name="afbeelding">
                @error('afbeelding')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{--leerlingen--}}
        <div class="form-group row">
            <label class="col-sm-2  col-form-label">Leerlingen</label>
            <div class="col-sm-6">
                <input class="form-control @error('leerlingen') is-invalid @enderror" type="text" name="leerlingen"
                       value="{{ old('leerlingen') }}">
                @error('leerlingen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{--link--}}
        <div class="form-group row">
            <label class="col-sm-2  col-form-label">Link (URL)</label>
            <div class="col-sm-6">
                <input class="form-control @error('link') is-invalid @enderror" type="text" name="link"
                       value="{{ old('link') }}">
                @error('link')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{--module naam--}}
        <div class="form-group row">
            <label class="col-sm-2  col-form-label">module naam *</label>
            <div class="col-sm-6">
                <select class="custom-select  mb-3 @error('module_id') is-invalid @enderror" id="module_naam"
                        name="module_id">
                    @if($errors->any())
                        @if($errors->has('module_id'))
                            <option disabled selected>Selecteer een module</option>
                        @else
                            <option value="{{ old('module_id') }}" selected>
                                waarde al ingevuld
                            </option>
                        @endif
                    @else
                        <option disabled selected>Selecteer een module</option>
                    @endif
                    @foreach($modules as $module)
                        <option value="{{$module -> id}}">
                            {{$module -> module_naam}}
                        </option>
                    @endforeach
                </select>
                @error('module_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{--categorie naam--}}
        <div class="form-group row">
            <label class="col-sm-2  col-form-label">categorie naam *</label>
            <div class="col-sm-6">
                <select class="custom-select  mb-3 @error('categorie_id') is-invalid @enderror" id="categorie_naam"
                        name="categorie_id">
                    @if($errors->any())
                        @if($errors->has('categorie_id'))
                            <option disabled selected>Selecteer een module</option>
                        @else
                            <option value="{{ old('categorie_id') }}" selected>
                                waarde al ingevuld
                            </option>
                        @endif
                    @else
                        <option disabled selected>Selecteer een categorie</option>
                    @endif
                    @foreach($categories as $categorie)
                        <option value="{{$categorie -> id}}">{{$categorie -> categorie_naam}}</option>
                    @endforeach
                </select>
                @error('categorie_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <br>

        {{--button--}}
        <div class="control">
            <button class="btn btn-outline-secondary" type="submit">Toevoegen</button>
        </div>
    </form>
    <br>
    <p>* verplichte velden</p>
@endsection
