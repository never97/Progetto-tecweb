@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row card mt-2 p-4">
            <div class="col-10 offset-1">
                <div class="row d-flex justify-content-center">

                    <form method="GET" action="{{action('App\Http\Controllers\SchedaOreController@filter')}}">
                        <div class="form-row">
                            <div class="col">
                                <input type="date" class="form-control" name="data_inizio" required value="{{$data_inizio}}">
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" name="data_fine" required value="{{$data_fine}}">
                            </div>
                            <input type="submit" class="btn btn-info" value="Filtra" />

                           {{-- <a href="operazioni" class="btn btn-info">indietro</a> --}}
                        </div>
                    </form>
                </div>

                <div class="row justify-content-center p-4">
                    <p>Sto filtrando da '{{date('d-m-Y', strtotime($data_inizio))}}' a '{{date('d-m-Y', strtotime($data_fine))}}'</p>
                </div>


                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Ore spese per progetto
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    @if($ore->isEmpty())
                                        <p>Nessun dato disponibile per questo intervallo di tempo</p>
                                    @else
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
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample1">
                        <div class="card">
                            <div class="card-header" id="headingOne1">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                                        Ore spese per cliente
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne1" class="collapse show" aria-labelledby="headingOne1" data-parent="#accordionExample1">
                                <div class="card-body">
                                    @if($clientiProg->isEmpty())
                                        <p>Nessun dato disponibile per questo intervallo di tempo</p>
                                    @else


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
                                                    <td class="somma">{{$ore1->nome_referente}} {{$ore1->cognome_referente}}</td>
                                                    <td class="somma">{{$ore1->totale}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>


@endsection


