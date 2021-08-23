@extends('layouts.app')
{{--@push('scripts')--}}
{{--    <script>--}}
{{--        function inviaDati(event) {--}}
{{--            event.preventDefault();--}}
{{--            let ragioneSociale = document.getElementsByName('ragione_sociale')[0].value;--}}
{{--            let nomeReferente = document.getElementsByName('nome_referente')[0].value;--}}
{{--            let cognomeReferente = document.getElementsByName('cognome_referente')[0].value;--}}
{{--            let emailReferente = document.getElementsByName('email_referente')[0].value;--}}
{{--            const data = {ragione_sociale: ragioneSociale, nome_referente: nomeReferente,--}}
{{--            cognome_referente : cognomeReferente, email_referente: emailReferente};--}}
{{--            fetch('/cliente/aggiungi', {--}}
{{--                method: 'POST', // or 'PUT'--}}
{{--                /*headers: {--}}
{{--                    'Content-Type': 'application/json',--}}
{{--                },*/--}}
{{--                body: JSON.stringify(data),--}}
{{--            })--}}
{{--                .then(response => response.json())--}}
{{--                .then(data => {--}}
{{--                    console.log('Success:', data);--}}
{{--                })--}}
{{--                .catch((error) => {--}}
{{--                    console.error('Error:', error);--}}
{{--                });--}}



{{--        }--}}
{{--    </script>--}}
{{--@endpush--}}
@push('scripts')
    <script>
        function elimina(event) {
            const id = event.target.getAttribute("data-id");
            let conf = confirm("Sei sicuro di voler cancellare ?");
            if(!conf) {
                return;
            }
            fetch('cliente/delete/'+id)
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
                            <button type="submit" class="btn btn-primary">Inserisci progetto</button>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-8">
                <div class="row">

                    @if($listaclienti->isEmpty())
                        <p>Non ci sono clienti presenti</p>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Ragione sociale</th>
                                <th>nome ref</th>
                                <th>cognome ref</th>
                                <th>email ref</th>
                                <th>Elimina</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listaclienti as $cliente)
                                <tr>
                                    <td>{{$cliente->ragione_sociale}}</td>
                                    <td>{{$cliente->nome_referente}}</td>
                                    <td>{{$cliente->cognome_referente}}</td>
                                    <td>{{$cliente->email_referente}}</td>

                                    <!--<td><a href=""></a>></td>>!-->
                                    <td><a onclick="elimina(event)" data-id="{{ $cliente->id }}" class="btn btn-danger">Elimina</a></td>
                                    <td><a href="{{ URL::action('App\Http\Controllers\ClienteController@edit', $cliente) }}" class="btn btn-danger">Modifica</a></td>


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
