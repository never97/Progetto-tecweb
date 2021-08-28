@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between">

            <div class="col-8">
                <div class="row">
{{--
                            @if($progetti->isEmpty())
                                <p>Non ci sono progetti presenti</p>
                            @else
                                <h1> Prima data </h1>
                                <h1> Seconda data </h1>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Cliente</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($progetti as $progetto)
                                        <tr>
                                            <th scope="row">{{ date('d/m/Y', strtotime($progetto->data_inizio_prevista)) }}</th>
                                            <th scope="row">{{ date('d/m/Y', strtotime($progetto->data_fine_prevista)) }}</th>


                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            @endif
                            <a href="{{ URL::action('App\Http\Controllers\ProgettoController@create') }}" class="btn btn-primary float-md-right mb-2">Aggiungi</a>

                        </div>
                    </div>
                    --}}@if($ore->isEmpty())
                        <p>Non ci sono schede presenti</p>
                    @else
                        <h1> Tutte le schede </h1>
                </div>
                <div class="row mb-2">
                    <form method="GET" action="{{action('App\Http\Controllers\SchedaOreController@filter')}}">
                        <div class="form-row">
                            <div class="col">
                                <input type="date" class="form-control" name="data_inizio" required value="{{$data_inizio}}">
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" name="data_fine" required value="{{$data_fine}}">
                            </div>
                            <input type="submit" class="btn btn-info" value="Cerca tra date"/>
                            <input type="reset" class="btn btn-danger" value="Reset"/>
                        </div>
                    </form>
                </div>
                <div class="row">
                        <p>Sto filtrando da {{$data_inizio}} a {{$data_fine}}</p>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nome progetto</th>
                        <th>Ore unitarie</th>
                    </tr>
                    </thead>
                    <tbody>{{--                            <td class="somma">{{$ore}}</td>
--}}
                    @foreach($ore as $ore1)
                        <tr>
                            <td class="somma">{{$ore1->nome}}</td>
                            <td class="somma">{{$ore1->totale}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection


