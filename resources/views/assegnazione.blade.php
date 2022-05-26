@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="col-4">

                <div class="row p-4"><h1> Assegnazione progetto </h1>
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
                                <label for="data_assegnazione">Data assegnazione</label>
                                <input type="date" name="data_assegnazione" class="form-control" id="data_assegnazione">
                            </div>
                            <div class="form-group">
                                <label for="">Dipendente</label>
                                <select class="form-control" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->nome }} {{ $user->cognome }}</option>
                                    @endforeach
                                </select>
                                <label for="">Progetto</label>
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
            <div class="col-8 p-4">
                <div class="row ">
                    <div class="col-10 offset-1">
                        <div class="row d-flex justify-content-center">

                            @if($assegnazioni->isEmpty())
                                <p>Non ci sono assegnazioni presenti</p>
                            @else
                                <h3 class="p-2"> Lista assegnazioni </h3>
                                <table class="table text-center">
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


