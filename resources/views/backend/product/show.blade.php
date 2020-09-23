@extends('layouts.backend')
@section('content')
    <a href="/backend/product">
        <button class="btn btn-outline-dark" type="button">Ga terug</button>
    </a>
    <hr>
    <p>{{$products->omschrijving}}</p>
@endsection
