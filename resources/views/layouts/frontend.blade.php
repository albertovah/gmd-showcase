<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../default.css">


    {{--bootstrap css--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <title>Showcases</title>
</head>
<body>
{{--container--}}
<div id="container-fluid">

    {{--header row, #header--}}
    <div class="row" id="header">

        {{--gedeelte 1 header, logo && titel --}}
        <div class="col-md-6">
            {{--logo (wit)--}}
            <div id="logo">
                {{--afbeelding logo--}}
                <img src="../images/has-logo.svg">
            </div>
            <h1 id="Title">Showcases</h1>
        </div>


        {{--zoekbalk--}}
        <div class="col-md-6">
            <form action="/" method="POST" role="search">
                @csrf
                <div class="input-group" id="search" id="search">
                    <input type="text" class="form-control" name="search" placeholder="Zoek product">
                    <button type="submit" class="btn btn-info" id="searchButton">
                        <img src="../images/icon.png" id="icon">
                    </button>
                </div>
            </form>
        </div>{{--einde col md-6--}}
    </div>{{--einde row--}}
    <div class="row" id="rowMenuGrijs">
        {{--grijze menu balk--}}
        <div class="col-12">
            <div id="grijsMenuBalk"></div>
        </div>
    </div>
</div>

{{--content--}}
<div class="container-fluid">
    @yield('content')
</div>
</body>
</html>

