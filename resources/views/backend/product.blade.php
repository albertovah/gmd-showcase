@extends('layouts.backend')
@section('content')
    {{--titel--}}
    <h1>Producten</h1>
    <a href="/home">
        <button type="button" class="btn btn-outline-dark">Ga terug</button>
    </a>
    <a href="/backend/product/create">
        <button type="button" class="btn btn-outline-dark">Nieuw product toevoegen</button>
    </a>
    <hr>
    <h2>Overview producten</h2>
    <hr>
    {{--zoek functie--}}
    <form action="/backend/product" method="POST" role="search" id="formProduct">
        @csrf
            {{--categorie selecteren--}}
            <select class="custom-select" name="categorie">
                <option disabled selected> categorie selecteren</option>
                @foreach($categories as $categorie)
                    <option value="{{$categorie->id}}">{{$categorie->categorie_naam}}</option>
                @endforeach
            </select>

            {{--module selecteren--}}
            <select class="custom-select" name="module">
                <option disabled selected> module selecteren</option>
                @foreach($modules as $module)
                    <option value="{{$module->id}}">{{$module->module_naam}}</option>
                @endforeach
            </select>

            {{--sorteren op --}}
            <select class="custom-select" id="sorteren" name="sorteer">
                <option selected value="id">Sorteren op</option>
                <option value="titel">Sorteer op Titel</option>
                <option value="created_at">Sorteer op Datum</option>
            </select>

            {{--buttons--}}
            <button type="submit"  class="btn btn-info">Zoeken</button>

    </form>


    {{--tabel--}}
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Titel</th>
            <th scope="col">Omschrijving</th>
            <th scope="col">Afbeelding</th>
            <th scope="col">Leerlingen</th>
            <th scope="col">Link (URL)</th>
            <th scope="col">Module</th>
            <th scope="col">Categorie</th>
            <th scope="col">Datum aangemaakt</th>
            <th scope="col">Datum geupdate
            <th scope="col"></th>
        </tr>
        </thead>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{$product -> id}}</th>
                <td>{{$product -> titel}}</td>
                <td><p>{!! nl2br(substr($product -> omschrijving, 0, 200))  !!}<a
                            href="/backend/product/show/{{$product -> id}}">
                            ..lees meer</a></p></td>
                <td>
                    @if(strlen ( $product -> afbeelding) > 0)
                        <img src="/storage/uploadedImages/{{$product->afbeelding}}">
                    @else
                        <p>Geen afbeelidng</p>
                    @endif
                </td>
                <td>{{$product -> leerlingen}}</td>
                <td>{{$product -> link}}</td>
                <td>{{$product -> module_naam}}</td>
                <td>{{$product -> categorie_naam}}</td>
                <td>{{$product -> created_at}}</td>
                <td>{{$product -> updated_at}}</td>
                <td>
                    <a onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')"
                       href="/backend/product/{{$product->id}}/delete">
                        <button type="button" class="btn btn-outline-danger">Verwijderen</button>
                    </a>
                    <a href="/backend/product/{{$product-> id}}/edit">
                        <button type="button" class="btn btn-outline-primary">Bewerken</button>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
