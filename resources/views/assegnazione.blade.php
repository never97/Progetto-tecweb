@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-3">
                <div class="row">
                    <div class="card w-100 p-2">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="form-assegnazione" method="post" action="{{action('App\Http\Controllers\AssegnazioneController@store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="data_assegnazione">data_assegnazione</label>
                                <input type="date" name="data_assegnazione" class="form-control" id="data_assegnazione">
                            </div>
                            <div class="form-group">
                                <label for="">Seleziona un dipendente</label>
                                <select class="form-control" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->nome }}</option>
                                    @endforeach
                                </select>
                                <label for="">Seleziona un progetto</label>
                                <select class="form-control" name="progetto_id">
                                    @foreach ($progetti as $progetto)
                                        <option value="{{ $progetto->id }}">{{ $progetto->nome }}</option>
                                    @endforeach
                                </select>
                            </div>





                            <button type="submit" class="btn btn-primary">Inserisci scheda</button>
                        </form>
                    </div>

                </div>
            </div>

            <div class="col-8">
                <div class="row">

                    @if($assegnazioni->isEmpty())
                        <p>Non ci sono assegnazioni presenti</p>
                    @else
                        <h1> Tutte le assegnazioni </h1>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Data</th>
                                <th>Dipendente</th>
                                <th>Progetto</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($assegnazioni as $asse)
                                <tr>
                                    <th scope="row">{{ date('d/m/Y', strtotime($asse->data_assegnazione)) }}</th>
                                    <td>{{$asse->user->nome . " " . $asse->user->cognome}}</td>
                                    <td>{{$asse->progetto->nome}}</td>


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


