@extends('layouts.app')

@section('content')

    <div class="container">
        <h1> Inserisci una nuova Spesa </h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-between">
            <div class="col-3">
                <div class="row">
                    <div class="card w-100 p-2">

                        <form id="form-progetti" method="post" action="{{action('App\Http\Controllers\ProgettoController@store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="">Seleziona un cliente</label>
                                <select class="form-control" name="cliente_id">
                                    @foreach ($clienti as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->cognome_referente }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nome">Nome progetto</label>
                                <input type="text" name="nome" class="form-control" id="nome">
                            </div>
                            <div class="form-group">
                                <label for="descrizione">Descrizione</label>
                                <input type="text" name="descrizione" class="form-control" id="descrizione">
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <input type="text" name="note" class="form-control" id="note">
                            </div>
                            <div class="form-group">
                                <label for="data_inizio_prevista">Previsione data inizio</label>
                                <input type="date" name="data_inizio_prevista" class="form-control" id="data_inizio_prevista">
                            </div>
                            <div class="form-group">
                                <label for="data_fine_prevista">Previsione data fine</label>
                                <input type="date" name="data_fine_prevista" class="form-control" id="data_fine_prevista">
                            </div>
                            <div class="form-group">
                                <label for="data_fine_effettiva">Effettiva data fine</label>
                                <input type="date" name="data_fine_effettiva" class="form-control" id="data_fine_effettiva">
                            </div>
                            <div class="form-group">
                                <label for="costo_orario">Costo orario</label>
                                <input type="number" name="costo_orario" min="1" step="1" max="500" class="form-control" id="costo_orario">
                            </div>
                            <button type="submit" class="btn btn-primary">Inserisci progetto</button>
                            <a href="{{ URL::action('App\Http\Controllers\ProgettoController@index') }}" class="btn btn-secondary">Indietro</a>


                        </form>
                    </div>

                </div>
            </div>
    </div>

@endsection
