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
        <div class="row">
            <div class="col-8 offset-2"><h2>Modifica utente</h2>
                <div class="row">
                    <div class="card w-100 p-4">
                        <form id="form-user" action="{{URL::action('App\Http\Controllers\UserController@update', $user)}}" method="post">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            {{-- <fieldset class="form-group row">
                                <legend class="col-form-label col-sm-3 float-sm-left pt-0">Ruolo</legend>
                                <div class="col-sm-8">

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role1" id="role1" value="admin"
                                                {{$user->is_admin ? "checked=\"checked\"": ""}}>
                                        <label class="form-check-label " for="role1">
                                            Admin
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="role2" value="std"
                                                {{!$user->is_admin ? "checked=\"checked\"": ""}}>
                                        <label class="form-check-label" for="role2">
                                            Semplice
                                        </label>
                                    </div>

                                </div>
                            </fieldset>
                            --}}


                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nome" class="col-sm-3 col-form-label">Nome utente</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nome" class="form-control" id="nome" value="{{$user->nome}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cognome" class="col-sm-3 col-form-label">Cognome utente</label>
                                <div class="col-sm-8">
                                    <input type="text" name="cognome" class="form-control" id="cognome" value="{{$user->cognome}}">
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="text" name="password" class="form-control" id="password">
                                </div>
                            </div>
                            <div class="row p-4">
                                <a href="{{ URL::action('App\Http\Controllers\UserController@index') }}" class="bi bi-arrow-left-circle-fill btn-lg"></a>

                                <input type="submit" value="Modifica utente" class="btn btn-primary d-block mx-auto "/>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
