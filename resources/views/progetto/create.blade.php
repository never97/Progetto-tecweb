@extends('layouts.app')

@section('content')

    <div class="container">


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-8 offset-2"><h1 class="text-center"> Inserisci un nuovo progetto </h1>
                <div class="row">
                    <div class="card w-100 p-4">

                        <form id="form-progetti" method="post" action="{{action('App\Http\Controllers\ProgettoController@store')}}">
                            @csrf
                            <div class="form-group row text-right">
                                <label for="" class="col-sm-3 col-form-label">Seleziona un cliente</label>
                                <div class="col-sm-8">
                                <select class="form-control" name="cliente_id" class="form-control mb-2 mr-sm-2">
                                    @foreach ($clienti as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->cognome_referente }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group row text-right">
                                <label for="nome" class="col-sm-3 col-form-label">Nome progetto</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nome" class="form-control mb-2 mr-sm-2" id="nome">
                                </div>
                            </div>
                            <div class="form-group row text-right">
                                <label for="descrizione" class="col-sm-3 col-form-label">Descrizione</label>
                                <div class="col-sm-8">
                                <input type="text" name="descrizione" class="form-control mb-2 mr-sm-2" id="descrizione">
                                </div>
                            </div>
                            <div class="form-group row text-right">
                                <label for="note" class="col-sm-3 col-form-label">Note</label>
                                <div class="col-sm-8">

                                <input type="text" name="note" class="form-control" id="note">
                                </div>
                            </div>
                            <div class="form-group row text-right">
                                <label for="data_inizio_prevista" class="col-sm-3 col-form-label">Previsione data inizio</label>
                                <div class="col-sm-8">

                                <input type="date" name="data_inizio_prevista" class="form-control" id="data_inizio_prevista">
                                </div>
                                </div>
                            <div class="form-group row text-right">
                                <label for="data_fine_prevista" class="col-sm-3 col-form-label">Previsione data fine</label>
                                <div class="col-sm-8">

                                <input type="date" name="data_fine_prevista" class="form-control" id="data_fine_prevista">
                                </div>
                                </div>
                            <div class="form-group row text-right">
                                <label for="data_fine_effettiva" class="col-sm-3 col-form-label">Effettiva data fine</label>
                                <div class="col-sm-8">
                                <input type="date" name="data_fine_effettiva" class="form-control" id="data_fine_effettiva">
                                </div>
                            </div>
                            <div class="form-group row text-right">
                                <label for="costo_orario" class="col-sm-3 col-form-label">Costo orario</label>
                                <div class="col-sm-8">
                                <input type="number" name="costo_orario" min="1" step="1" max="500" class="form-control" id="costo_orario">
                                </div>
                                </div>
                            <div class="row p-4">

                                <a href="{{ URL::action('App\Http\Controllers\ProgettoController@index') }}"  class="bi bi-arrow-left-circle-fill btn-lg"></a>
                                <input type="submit" value="Inserisci progetto" class="btn btn-primary d-block mx-auto "/>


                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

@endsection
