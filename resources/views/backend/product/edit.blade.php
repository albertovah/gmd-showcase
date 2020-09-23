@extends('layouts.backend')
@section('content')
    <h1>Producten</h1>
    <a href="/backend/product">
        <button class="btn btn-outline-dark" type="button">Ga terug</button>
    </a>
    <hr>
    <h2>Product bewerken</h2>
    <form action="/backend/product/{{$product -> id}}/update" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if($errors->any())
            <p class="alert alert-danger"> Controleer input</p>
        @endif        {{--Id--}}
        <input class="form-control" type="text" name="id"
               value="{{$product->id}}" hidden>


        {{--Titel--}}
        <div class="form-group row">
            <label class="col-sm-2  col-form-label">Titel *</label>
            <div class="col-sm-6">
                <input class="form-control @error('titel') is-invalid @enderror" type="text" name="titel"
                       value="{{old('titel') ? old('titel') : $product->titel}}">
                @error('titel')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{--omschrijving--}}
        <div class="form-group row">
            <label class="col-sm-2  col-form-label">Omschrijving *</label>
            <div class="col-sm-10">
                <textarea style="height: 500px" class="form-control @error('omschrijving') is-invalid @enderror"
                          type="text" name="omschrijving"
                          value="{{old('omschrijving')?old('omschrijving'):$product->omschrijving}}">{{ old('omschrijving')?old('omschrijving') : $product -> omschrijving}}</textarea>
                @error('omschrijving')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{--Afbeelding--}}
        <div class="form-group row">
            {{--label--}}
            <label class="col-md-2  col-form-label">Afbeelding</label>
            {{--hidden, niet te zien. Is voor de controller zodat hij weet of er een afbeelind al was--}}
            <input class="form-control" type="text" name="HeeftAfbeelding"
                   value="@if($product->afbeelding != null)ja @else nee @endif" hidden>
            {{--div--}}
            <div class="col-md-6" style="background-color: white; border-radius: 10px; padding: 10px;">
                @if($product->afbeelding != null)
                    <label>huidige afbeelding:</label>
                    <img style="float: right" src="/storage/uploadedImages/{{$product->afbeelding}}">
                    <br><br>
                    <input type="checkbox" value="deleteImage" name="imageStatus"> afbeelding verwijderen</input>
                    <br><br>
                @endif
                {{--nieuwe afbeelding selecteren--}}
                <input class="form-control btn-info  @error('afbeelding') is-invalid @enderror" id="afbeelding"
                       type="file" name="afbeelding"
                       value="{{old('afbeelding')?old('afbeelding'):$product->afbeelding}}">
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
                       value="{{old('leerlingen')?old('leerlingen'):$product -> leerlingen}}">
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
                       value="{{old('link')?old('old'):$product -> link}}">
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
                <select class="custom-select  mb-3 @error('module_id') is-invalid @enderror" id="categorie_naam"
                        name="module_id">
                    @if(old('module_id')){{--controlleer of er een old is--}}
                    <option value="{{old('module_id')}}" selected>module geselecteerd</option>
                    @else
                        <option value="{{$module->id}}" selected="true">{{$module->module_naam}}</option>
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
                    @if(old('categorie_id'))
                        <option value="{{old('categorie_id')}}" selected>categorie geslecteerd</option>
                    @else
                        <option value="{{$categorie->id}}" selected="true">{{$categorie->categorie_naam}}</option>
                    @endif
                    @foreach($categories as $categorie)
                        <option value="{{$categorie -> id}}">
                            {{$categorie -> categorie_naam}}
                        </option>
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
            <button class="btn btn-outline-secondary" type="submit">Bewerken</button>
        </div>
    </form>
    <br>
    <p>* verplichte velden</p>
@endsection
