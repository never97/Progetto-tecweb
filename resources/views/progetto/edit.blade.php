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
            <div class="row justify-content-between">
                <div class="col-3">
                    <div class="row">
                        <div class="card w-100 p-2">


                            <form id="form-user" action="{{URL::action('App\Http\Controllers\ProgettoController@update', $progetto)}}" method="post">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="nome">Nome progetto</label>
                                    <input type="text" name="nome" class="form-control" id="nome" value="{{$progetto->nome}}">
                                </div>
                                <div class="form-group">
                                    <label for="descrizione">Descrizione</label>
                                    <input type="text" name="descrizione" class="form-control" id="descrizione" value="{{$progetto->descrizione}}">
                                </div>
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <input type="text" name="note" class="form-control" id="note" value="{{$progetto->note}}">
                                </div>
                                <div class="form-group">
                                    <label for="data_inizio_prevista">Previsione data inizio</label>
                                    <input type="date" name="data_inizio_prevista" class="form-control" id="data_inizio_prevista" value={{date('Y-m-g', strtotime($progetto->data_inizio_prevista))}}>
                                </div>
                                <div class="form-group">
                                    <label for="data_fine_prevista">Previsione data fine</label>
                                    <input type="date" name="data_fine_prevista" class="form-control" id="data_fine_prevista" value="{{date('Y-m-g', strtotime($progetto->data_fine_prevista))}}">
                                </div>
                                <div class="form-group">
                                    <label for="data_fine_effettiva">Effettiva data fine</label>
                                    <input type="date" name="data_fine_effettiva" class="form-control" id="data_fine_effettiva" value="{{date('Y-m-g', strtotime($progetto->data_fine_effettiva))}}">
                                </div>
                                <div class="form-group">
                                    <label for="costo_orario">Costo orario</label>
                                    <input type="number" name="costo_orario" min="1" step="1" max="500" class="form-control" id="costo_orario" value="{{$progetto->costo_orario}}">
                                </div>
                                <a href="{{ URL::action('App\Http\Controllers\ProgettoController@index') }}" class="bi bi-arrow-left-square-fill"></a>

                                <button type="submit" class="btn btn-primary">Inserisci progetto</button>

                            </form>
                        </div>

                    </div>

        </div>
    </div>
@endsection
