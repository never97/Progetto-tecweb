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

            <div class="col-8">
                <div class="row">

                    @if($progetti->isEmpty())
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
                            @foreach($progetti as $progetto)
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
                        <a href="{{ URL::action('App\Http\Controllers\ProgettoController@create') }}" class="btn btn-primary float-md-right mb-2">Aggiungi</a>

                </div>
            </div>
        </div>
    </div>
@endsection
