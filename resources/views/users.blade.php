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
                                    <div class="row">
                                        <div class="col">
                                            <label for="role">Admin</label>
                                            <input type="radio" name="role" class="form-control-sm" id="role1" value="admin">
                                        </div>
                                        <div class="col">
                                            <label for="role2">Semplice</label>
                                            <input type="radio" name="role" class="form-control-sm" id="role2" value="std">
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

                    @if($listautenti->isEmpty())
                        <p>Non ci sono utenti presenti</p>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Email</th>
                            <th>Ruolo</th>
                            <th>Elimina</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listautenti as $user)
                            <tr>
                                <td>{{$user->nome}}</td>
                                <td>{{$user->cognome}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->is_admin === 0 ? "Utente semplice" : "Amministratore"}}</td>
                                <td><button class="btn btn-danger">Elimina</button> </td>
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
