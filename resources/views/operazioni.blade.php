@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between">

            <div class="col-8">
                <div class="row">

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
                            <a href="operazioni" class="btn btn-info">indietro</a>
                        </div>
                    </form>
                </div>

                <div class="row">
                        <p>Sto filtrando da {{$data_inizio}} a {{$data_fine}}</p>
                </div>
                @if($ore->isEmpty())
                        <p>Non ci sono schede presenti</p>
                    @else

                    <p>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseProgetti" aria-expanded="false" aria-controls="collapseExample">
                            Mostra le ore spese per ogni progetto
                        </button>
                    </p>

                <div class="collapse" id="collapseProgetti">
                    <div class="card card-body">
                        <h1> Tutte le schede </h1>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nome progetto</th>
                                <th>Ore unitarie</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ore as $ore1)
                                <tr>
                                    <td class="somma">{{$ore1->nome}}</td>
                                    <td class="somma">{{$ore1->totale}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @if($clientiProg->isEmpty())
                    <p>Non ci sono schede presenti</p>
                @else

                    <p>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseClienti" aria-expanded="false" aria-controls="collapseExample">
                            Mostra le ore spese per ogni cliente
                        </button>
                    </p>

                    <div class="collapse" id="collapseClienti">
                        <div class="card card-body">
                            <h1> Tutte le schede </h1>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nome cliente</th>
                                    <th>Ore unitarie</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clientiProg as $ore1)
                                    <tr>
                                        <td class="somma">{{$ore1->nome_referente}}</td>
                                        <td class="somma">{{$ore1->totale}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>


@endsection


