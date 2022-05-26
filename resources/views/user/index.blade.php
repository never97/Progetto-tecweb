@extends('layouts.app')
@push('scripts')
    <script>
        function copia() {
            let valore = document.getElementById('password_generata').value;
            document.getElementById('password').setAttribute('value', valore);
        }
        function elimina(event) {
            const id = event.target.getAttribute("data-id");
            let conf = confirm("Sei sicuro di voler cancellare ?");
            if(!conf) {
                return;
            }
            fetch('user/delete/'+id)
                .then(response => response.json())
                .then(data =>{
                    console.log(data);
                    if(data.status === "ok") {
                        event.target.parentElement.parentElement.remove();
                    }else{
                        alert("impossibile eliminare: eliminare prima le relative dipendenze");

                    }
                });
        }
    </script>
@endpush
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
                <div class="row"><h1>Utente</h1>
                    <div class="card w-100 p-2">
                        <form id="form-user" method="post" action="{{action('App\Http\Controllers\UserController@store')}}">
                            @csrf
                            <div class="form-group p-1">
                                Ruolo
                                <div class="row p-1">

                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="role1" value="admin" checked>
                                    <label class="form-check-label" for="role1">
                                        Admin
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="role2" value="std">
                                    <label class="form-check-label" for="role2">
                                        Semplice
                                    </label>
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
                        <h3 class="p-2">Lista utenti</h3>
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Cognome</th>
                                <th>Email</th>
                                <th>Ruolo</th>
                                <th>Modifica</th>
                                <th>Elimina</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listautenti as $user)
                                <tr>
                                    <td>{{$user->nome}}</td>
                                    <td>{{$user->cognome}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->is_admin == 0 ? "Utente semplice" : "Amministratore"}}</td>
                                    <!--<td><a href=""></a>></td>>!-->
                                    <td><a href="{{ URL::action('App\Http\Controllers\UserController@edit', $user) }}" ><i class="bi bi-pencil-square" style="color:#198754;"></i></a></td>
                                    <td><a onclick="elimina(event)" data-id="{{$user->id}}" class="bi bi-x-lg" style="color: #dc3545;"></a></td>


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