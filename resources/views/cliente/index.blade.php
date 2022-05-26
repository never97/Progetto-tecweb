@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row justify-content-between p-4">
            <div class="col-3">
                <h1> Cliente </h1>
                <div class="row">
                    <div class="card w-100 p-2">
                        <form id="form-clienti" method="post" action="{{action('App\Http\Controllers\ClienteController@store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="ragione_sociale">Ragione sociale</label>
                                <input type="text" name="ragione_sociale" class="form-control" id="ragione_sociale">
                            </div>
                            <div class="form-group">
                                <label for="nome_referente">Nome referente</label>
                                <input type="text" name="nome_referente" class="form-control" id="nome_referente">
                            </div>
                            <div class="form-group">
                                <label for="cognome_referente">Cognome referente</label>
                                <input type="text" name="cognome_referente" class="form-control" id="cognome_referente">
                            </div>
                            <div class="form-group">
                                <label for="email_referente">Email referente</label>
                                <input type="text" name="email_referente" class="form-control" id="email_referente">
                            </div>
                            <button type="submit" class="btn btn-primary">Inserisci cliente</button>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-8">
                <div class="row">

                    @if($listaclienti->isEmpty())
                        <p>Non ci sono clienti presenti</p>
                    @else
                        <h3 class="p-2">Lista clienti</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Ragione sociale</th>
                                <th>Nome referente</th>
                                <th>Cognome referente</th>
                                <th>Email referente</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listaclienti as $cliente)
                                <tr>
                                    <td>{{$cliente->ragione_sociale}}</td>
                                    <td>{{$cliente->nome_referente}}</td>
                                    <td>{{$cliente->cognome_referente}}</td>
                                    <td>{{$cliente->email_referente}}</td>

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
