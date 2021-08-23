@extends('layouts.app')
@push('scripts')
    <script>
        function elimina(event) {
            const id = event.target.getAttribute("data-id");
            let conf = confirm("Sei sicuro di voler cancellare ?");
            if(!conf) {
                return;
            }
            fetch('progetto/delete/'+id)
                .then(response => response.json())
                .then(data =>{
                    console.log(data);
                    if(data.status === "ok") {
                        event.target.parentElement.parentElement.remove();
                    }});

        }
    </script>
@endpush
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

                        <form id="form-progetti" method="post" action="{{action('App\Http\Controllers\ProgettoController@store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="">Seleziona un cliente</label>
                                <select class="form-control" name="cliente_id">
                                    @foreach ($listaclienti as $cliente)
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

                        </form>
                    </div>

                </div>
            </div>
            <div class="col-8">
                <div class="row">

                    @if($listaprogetti->isEmpty())
                        <p>Non ci sono progetti presenti</p>
                    @else
                        <h1> Progetti </h1>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Nome</th>
                                <th>Descrizione</th>
                                <th>Note</th>
                                <th>Data inizio prev</th>
                                <th>Data fine prev</th>
                                <th>Data fine</th>
                                <th>Costo orario</th>
                                <th>Elimina</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listaprogetti as $progetto)
                                <tr>
                                    <td>{{$progetto->cliente->cognome_referente}}</td>
                                    <td>{{$progetto->nome}}</td>
                                    <td>{{$progetto->descrizione}}</td>
                                    <td>{{$progetto->note}}</td>
                                    <th scope="row">{{ date('d/m/Y', strtotime($progetto->data_inizio_prevista)) }}</th>
                                    <th scope="row">{{ date('d/m/Y', strtotime($progetto->data_fine_prevista)) }}</th>
                                    <th scope="row">{{ date('d/m/Y', strtotime($progetto->data_fine_effettiva)) }}</th>

                                    <td>{{$progetto->costo_orario}}</td>

                                    <!--<td><a href=""></a>></td>>!-->
                                    <td><a onclick="elimina(event)" data-id="{{ $progetto->id }}" class="btn btn-danger">Elimina</a></td>
                                    <td><a href="{{ URL::action('App\Http\Controllers\ProgettoController@edit', $progetto) }}" class="btn btn-danger">Modifica</a></td>


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
