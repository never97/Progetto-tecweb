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
            <div class="col-8 offset-2"><h2>Modifica progetto</h2>
                <div class="row">
                    <div class="card w-100 p-4">


                        <form id="form-user" action="{{URL::action('App\Http\Controllers\ProgettoController@update', $progetto)}}" method="post">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="nome" class="col-sm-3 col-form-label">Nome progetto</label>
                                <div class="col-sm-8">
                                    <input type="text" required name="nome" class="form-control" id="nome" value="{{$progetto->nome}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descrizione" class="col-sm-3 col-form-label">Descrizione</label>
                                <div class="col-sm-8">
                                    <input type="text" required name="descrizione" class="form-control" id="descrizione" value="{{$progetto->descrizione}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="note" class="col-sm-3 col-form-label">Note</label>
                                <div class="col-sm-8">
                                    <input type="text" name="note" class="form-control" id="note" value="{{$progetto->note}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data_inizio_prevista" class="col-sm-3 col-form-label">Previsione data inizio</label>
                                <div class="col-sm-8">
                                    <input type="date" required name="data_inizio_prevista" class="form-control" id="data_inizio_prevista" value={{date('Y-m-g', strtotime($progetto->data_inizio_prevista))}}>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data_fine_prevista" class="col-sm-3 col-form-label">Previsione data fine</label>
                                <div class="col-sm-8">
                                    <input type="date" required name="data_fine_prevista" class="form-control" id="data_fine_prevista" value="{{date('Y-m-g', strtotime($progetto->data_fine_prevista))}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data_fine_effettiva" class="col-sm-3 col-form-label">Effettiva data fine</label>
                                <div class="col-sm-8">
                                    <input type="date" name="data_fine_effettiva" class="form-control" id="data_fine_effettiva"
                                           @if ($progetto->data_fine_effettiva!==null)
                                           value="{{date('Y-m-g', strtotime($progetto->data_fine_effettiva))}}"
                                            @endif
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="costo_orario" class="col-sm-3 col-form-label">Costo orario</label>
                                <div class="col-sm-8">
                                    <input type="number" required name="costo_orario" min="1" step="1" max="500" class="form-control" id="costo_orario" value="{{$progetto->costo_orario}}">
                                </div>
                            </div>
                            <div class="row p-4">
                                <a href="{{ URL::action('App\Http\Controllers\ProgettoController@index') }}" class="bi bi-arrow-left-circle-fill btn-lg"></a>

                                <input type="submit" value="Modifica progetto" class="btn btn-primary d-block mx-auto "/>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
@endsection
