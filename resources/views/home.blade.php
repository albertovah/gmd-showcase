@extends('layouts.backend')
@section('login')
    {{--dit is de pagina waar de gebruiker op terecht komt nadat hij is ingelogd--}}
    <div class="container">{{--container--}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card"> {{--de div waarin de items worden weergeven--}}
                    <div class="card-header" style="text-align: center">Dashboard</div>
                    {{--de body--}}
                    <div class="card-body" style="text-align: center">
                        @if (session('status')){{-- iets met status van de sessie--}}
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="/backend/product">{{--link naar product pagina--}}
                            <button class="btn btn-secondary" style="width: 200px">product</button>
                        </a>
                            <br><br>
                        <a href="/backend/categorie"> {{--link naar categorie pagina--}}
                            <button class="btn btn-secondary" style="width: 200px">categorie</button>
                        </a>
                            <br><br>
                        <a href="/backend/module"> {{--link naar modue pagina--}}
                            <button class="btn btn-secondary" style="width: 200px">module</button>
                        </a>
                            <br><br>
                        @can ('edit-users') {{--alleen voor administrators, hier knnen gebruikers aangemaakt, geweizigd en verwijdered worden--}}
                            <form method="GET" action="/backend/gebruiker">
                                @csrf
                                <button class="btn btn-secondary" type="submit" style="width: 200px">gebruiker</button>
                            </form>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
