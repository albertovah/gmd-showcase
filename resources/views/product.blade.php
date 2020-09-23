@extends('layouts.frontend')
@section('content')
    {{-- eerste row--}}
    <div class="row">
        {{--div die de hele row opneemt --}}
        <div class="col-md-12">
            <br>
            {{--button om terug te gaan--}}
            <button class="btn btn-info" id="button"><a href="/">Go Back</a></button>
        </div>
    </div>

    {{--tweede row, in deze row staat het product--}}
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            {{--titel van het product--}}
            <h1>{{$products -> titel}}</h1>
        </div>
    </div>
    {{-- tonen van een afbeelding als er een afbeelding is--}}
    @if(strlen ($products -> afbeelding) > 0)
        <div class="row">
            <div class="col-md-2"></div> {{--lege div voor opvulling--}}
            <div id="productImgDiv" class="col-md-8">
                <img width="100%" src="/storage/uploadedImages/{{$products->afbeelding}}">{{--afbeelding--}}
                <p id="date">{{$products -> created_at}}</p> {{--datum van het product--}}
            </div>
            <div class="col-md-2"></div>{{--lege div voor opvulling--}}
        </div>
    @endif
    {{--row voor de omschrijving--}}
    <div class="row">
        <div class="col-md-1"></div>{{--lege div voor opvulling--}}
        <div class="col-md-10">
            <p> {!! nl2br($products -> omschrijving)  !!}</p>
        </div>
        <div class="col-md-1"></div>{{--lege div voor opvulling--}}
    </div>
    {{--laatste row met de informatie--}}
    <div class="row" style="margin-bottom: 150px">
        <div class="col-md-1"></div>{{--lege div voor opvulling--}}
        <div class="col-md-10"> {{--div met de info--}}
            @if(strlen($products -> link) > 0) {{--als er een link is, tonen van de link--}}
                Link: <a href="https://{{$products -> link}}" target="_blank">{{$products -> link }}</a>
            @endif
            @if(strlen($products -> leerlingen) > 0){{--als er leerlingen zijn, tonen van de leerlingen--}}
                <p>Leerlingen: {{$products -> leerlingen}}</p>
            @endif
            <p>Module: {{$module_naam}}<br>Categorie: {{$categorie_naam}}</p> {{--tonen van de categorie en de module--}}
        </div>
        <div class="col-md-1"></div>{{--lege div voor opvulling--}}
    </div>
@endsection

