@extends('layouts.frontend')
@section('content')
    <div class="row"> {{--row--}}
        <div class="col-md-2" class="pos-f-t" id="navbar">
            {{--button--}}
            <nav class="navbar navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            {{--content dat gecolapsed word--}}
            <div class="collapse" id="navbarToggleExternalContent">
                {{--form waarin de gegevens geladen word--}}
                <form action="/" method="POST" role="search">
                    @csrf
                    <div class="p-4" id="noPaddingTop">

                        {{--categorie selecteren--}}
                        <select class="form-control" name="categorie">
                            <option disabled selected> categorie selecteren</option>
                            @foreach($categories as $categorie)
                                <option value="{{$categorie->id}}">{{$categorie->categorie_naam}}</option>
                            @endforeach
                        </select>
                        <br>

                        {{--module selecteren--}}
                        <select class="form-control" name="module">
                            <option disabled selected> module selecteren</option>
                            @foreach($modules as $module)
                                <option value="{{$module->id}}">{{$module->module_naam}}</option>
                            @endforeach
                        </select>
                        <br>

                        {{--sorteren op --}}
                        <select class="custom-select  mb-3" id="sorteren" name="sorteer">
                            <option selected value="id">Sorteren op </option>
                            <option value="titel">Sorteer op Titel</option>
                            <option value="created_at">Sorteer op Datum</option>
                        </select>
                        <hr>

                        {{--buttons--}}
                        <button type="submit" id="filterButton1" class="btn btn-info">Zoeken</button>
                        <button class="btn btn-info" id="filterButton2"><a href="/">Alles tonen</a></button>
                    </div>
                </form>
            </div>
        </div>{{--end col-md-3 && collapsable content--}}
        <div class="col-md-9" style="height: 100%">
            <br><br>
            <div class="row" style="margin-bottom: 150px">
                {{-- voor wanneer er een error is te zien--}}
                @if(isset($error))
                    <div class="col-md-12">
                        <p style="text-align: center">{{$error}} <a href="/">alles weergeven</a></p>
                    </div>
                @else
                    {{--als er geen error is te zien worden alle producten hieronder weergeven--}}

                {{--$products is een verzameling van alle producten, elk product in deze verzameling word apart getoont door deze forloop, en is een $product--}}
                    @foreach($products as $product)
                       {{--div--}}
                        <div class="col-md-4">
                            {{--titel--}}
                            <h1 class="productTitle"><a href="/product/{{$product -> id}}">{{$product -> titel}}</a></h1>
                            {{--als er een afbeelding is--}}
                            @if(strlen ($product -> afbeelding) > 0)
                                <div class="ImgDiv"> {{--tonen afbeelding--}}
                                    <img id="Img" src="/storage/uploadedImages/{{$product->afbeelding}}">
                                </div> {{--tonen kortere tekst (ivm afbeelding)--}}
                                <p>{!! nl2br((substr($product -> omschrijving, 0, 200) )) !!}<a
                                        href="/product/{{$product -> id}}">
                                        ..lees meer</a></p>
                            @else{{--als er geen afbeelding is--}}
                        {{--tonen langere tekst om ruimte van afbeelding op te vullen--}}
                                <p>{!! nl2br((substr($product -> omschrijving, 0, 300) )) !!}<a
                                        href="/product/{{$product -> id}}">
                                        ..lees meer</a></p>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>{{--end row--}}
        </div>{{--end col-md-9--}}
        <div class="col-md-1"></div>{{--voor ruimte rechts--}}
    </div>{{--end row--}}
@endsection


