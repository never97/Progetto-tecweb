@extends('layouts.app')
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
                        <form id="form-user" action="{{URL::action('App\Http\Controllers\UserController@update', $user)}}" method="post">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                Ruolo
                                <div class="row">
                                    <div class="col">
                                        <label for="role1">Admin</label>
                                            <input type="radio" name="role" class="form-control-sm" id="role1" value="admin"
                                                    {{$user->is_admin ? "checked=\"checked\"": ""}}>
                                    </div>
                                    <div class="col">
                                        <label for="role2">Semplice</label>
                                        <input type="radio" name="role" class="form-control-sm" id="role2" value="std"
                                                {{!$user->is_admin ? "checked=\"checked\"": ""}}>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="nome">Nome utente</label>
                                <input type="text" name="nome" class="form-control" id="nome" value="{{$user->nome}}">
                            </div>
                            <div class="form-group">
                                <label for="cognome">Cognome utente</label>
                                <input type="text" name="cognome" class="form-control" id="cognome" value="{{$user->cognome}}">
                            </div>

                            <div class="form-group">

                                <label for="password">Password</label>
                                <input type="text" name="password" class="form-control" id="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Aggiorna utente</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
