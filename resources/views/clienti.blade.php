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
@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-3">
            <div class="row">
                <div class="card w-100 p-2">
                    <form id="form-cliente" method="post" action="{{url('/cliente/aggiungi')}}">
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
                @forelse ($listaclienti as $cliente)
                <li>{{ $cliente->ragione_sociale}}</li>
                @empty
                <p>No clienti presenti</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
