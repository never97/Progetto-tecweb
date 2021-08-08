@extends('layouts.app')
@push('scripts')
    <script>
        function copia() {
            let valore = document.getElementById('password_generata').value;
            document.getElementById('password').setAttribute('value', valore);
        }
    </script>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-3">
                <div class="row">
                    <div class="card w-100 p-2">
                        <form id="form-user" method="post" action="{{url('/user/aggiungi')}}">
                            @csrf
                            <div class="form-group">
                                Ruolo
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <input type="radio" name="role" class="form-control-sm" id="role" value="admin">
                                            <label for="name">Admin</label>
                                        </div>
                                        <div class="col">
                                            <input type="radio" name="role" class="form-control-sm" id="role" value="std">
                                            <label for="name">Semplice</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="nome">Nome utente</label>
                                <input type="text" name="nome" class="form-control" id="nome">
                            </div>
                            <div class="form-group">
                                <label for="cognome">Cognome utente</label>
                                <input type="text" name="cognome" class="form-control" id="cognome">
                            </div>
                            <div class="form-group">
                                <label for="password_generata">Password consigliata</label>
                                <input type="text" readonly="readonly" class="form-control" value="{{Str::random(8)}}"
                                id="password_generata"/>
                                <input type="button" class="btn btn-primary mt-2" onclick="copia()" value="Usa questa password"/>
                            </div>
                            <div class="form-group">

                                <label for="password">Password</label>
                                <input type="text" name="password" class="form-control" id="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Inserisci utente</button>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-8">
                <div class="row">
                    @forelse ($listautenti as $user)
                        <li>{{ $user->nome}}</li>
                    @empty
                        <p>No utenti presenti</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
