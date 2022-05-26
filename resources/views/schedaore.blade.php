@extends('layouts.app')

@push('scripts')
    <script>
        let conferma = false;

        function setConfermaTrue() {
            conferma = true;
        }
        const event=null;
        function setEvent() {
            return event;
        }
        function editscheda(id) {
            fetch(`schedaore/${id}`, {method: "GET"})
                .then(response => response.json())
                .then(data => {
                    if(data.status === "ok") {
                        console.log(data);
                        $("#schedaoreModal").modal('toggle');
                        $('#schedaoreForm input[name=data_odierna]').attr("value", data.data_odierna.split('T')[0]);
                        $('#schedaoreForm input[name=note]').attr("value", data.note);
                        $('#schedaoreForm input[name=ore_unitarie]').attr("value", data.ore_unitarie);
                        $('#schedaoreForm input[name=id]').attr("value", id);
                    }else{alert("result");}
                });

        }
        function formattedDate(d) {
            s = d.split('T')[0];
            ds = s.split('-').reverse().join("/");
            return ds;
        }
        function editAsync(event) {
            event.preventDefault();

            $("#schedaoreModal").modal('hide');
            const token = document.querySelector('meta[name="csrf-token"]').content
            let form = new FormData(document.getElementById('schedaoreForm'));

            fetch('schedaore/update', {
                method: "PUT",
                headers: {
                    'Content-Type': 'application/json; charset=utf-8',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(Object.fromEntries(form))
            }).then(data => data.json())
                .catch((error) => {
                    //alert(JSON.stringify(Object.fromEntries(form)));
                    $(document).ready(function() {
                        $('#myModalError').modal('show');
                    });
                })
                .then(res => {

                        if(res.status === "ok") {
                            $('#sid'+ form.get('id')+ " .data_odierna").html(formattedDate(res.data_odierna));
                            $('#sid'+ form.get('id')+ " .ore_unitarie").html(res.ore_unitarie);
                            $('#sid'+ form.get('id')+ " .note").html(res.note);
                            //alert("Modificato");
                            $(document).ready(function() {
                                $('#myModal').modal('show');
                            });
                        }
                    }
                );
        }

        function EliminaConfirm(event) {
            id = event.target.getAttribute("data-id");
            console.log("Inizio funzione di conferma");
            console.log("ID",id);

            $('#myModalDelete').modal('show');
            //let conf = confirm("Sei sicuro di voler cancellare ?");

            console.log(conferma);


            console.log("Fine funzione di conferma");
            console.log(event);
            delet=event.target.parentElement.parentElement;

            console.log(delet);

            //prova(id);



        }
        {{-- function prova(id){
            var idd=id;
            console.log("idd",idd);

            return idd;
        }--}}
        function elimina() {


            //const id = event.target.getAttribute("data-id");
            //id1=prova();
            console.log("Inizio funzione elimina vera e propria",conferma);
            console.log("ID",id);

            if(!conferma){
                return;
            }else {
                conferma = false;
            }
            fetch('schedaore/delete/'+id)
                .then(response => response.json())
                .then(data =>{
                    console.log(data);
                    if(data.status === "ok") {
                        delet.remove();
                    }});
            $('#alertEliminato').modal('show');
        }

    </script>
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-between p-4">
            <div class="col-3">
                <div class="row"><h1>Scheda ore</h1>
                    <div class="card w-100 p-2">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="form-schede_ore" method="post" action="{{action('App\Http\Controllers\SchedaOreController@store')}}">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="user_id">Dipendente</label>
                                <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}" id="user_id"/>
                                <input disabled class="form-control" value="{{ Auth::user()->cognome }}"/>

                            </div>
                            <div class="form-group">
                                <label for="progetto_id">Progetto</label>
                                <select class="form-control" name="progetto_id">
                                    @foreach ($progetti as $progetto)
                                        <option value="{{ $progetto->id }}">{{ $progetto->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="data_odierna">Data odierna </label>

                                <input type="date" name="data_odierna" class="form-control" value="{{ Carbon\Carbon::today()->format('Y-m-d') }}" id="data_odierna" >
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <input type="text" name="note" class="form-control" id="note">
                            </div>

                            <div class="form-group">
                                <label for="ore_unitarie">Ore impiegate</label>
                                <input type="number" name="ore_unitarie" min="1" max="15" class="form-control" id="ore_unitarie">
                            </div>
                            <button type="submit" class="btn btn-primary">Inserisci scheda</button>

                        </form>
                    </div>

                </div>
            </div>

            <div class="col-8">
                <div class="row">

                    @if($schede->isEmpty())
                        <p>Non ci sono schede presenti</p>
                    @else
                        <h3 class="p-2"> Lista schede </h3>
                </div>
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th>Data odierna</th>
                        <th>Ore unitarie</th>
                        <th>Note</th>
                        <th>Progetto</th>
                        <th>Modifica</th>
                        <th>Elimina</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($schede as $schede_ore)
                        <tr id="sid{{$schede_ore->id}}">
                            <td class="data_odierna">{{ date('d/m/Y', strtotime($schede_ore->data_odierna)) }}</td>
                            <td class="ore_unitarie">{{$schede_ore->ore_unitarie}}</td>
                            <td class="note">{{$schede_ore->note}}</td>
                            {{--  <td class="user_id">{{$schede_ore->user->nome}} {{$schede_ore->user->cognome}}</td>
                             --}}<td class="progetto_id">{{$schede_ore->progetto->nome}}</td>
                            {{-- <td><a href="#" class="btn btn-outline-danger btn-sm delete-btn" data-id="{{ $schede_ore->id }}">Elimina</a></td>
                             <td><a onclick="modifica(event)" data-id="{{$schede_ore->id}}" class="btn btn-danger">Modifica</a></td>
--}}                            {{----}}<td><a href="javascript:editscheda({{$schede_ore->id}})"  data-id="{{ $schede_ore->id }}"><i class="bi bi-pencil-square" style="color:#198754;"></i></a></td>
                            <td><a href="#" onclick="EliminaConfirm(event)" data-id="{{$schede_ore->id}}" class="bi bi-x-lg" style="color: #dc3545;"></a></td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
                @endif
            </div>
        </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="schedaoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modifica scheda ore</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="schedaoreForm" onsubmit="return editAsync(event)">
                            @csrf
                            <input type="hidden" id="id" name="id"/>
                            <div class="form-group">
                                <label for="data_odierna">Data</label>
                                <input type="date" class="form-control" name="data_odierna" id="data_odierna1">
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <input type="text" class="form-control" name="note" id="note1">
                            </div>
                            <div class="form-group">
                                <label for="ore_unitarie">Ore</label>
                                <input required type="number" class="form-control" name="ore_unitarie" min="1" step="1" max="15" id="ore_unitarie1">
                            </div>
                            <button type="submit" onsubmit="return editAsync(event)" class="btn btn-primary">Salva</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <div class="modal fade"  id="myModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog"  role="document">

            <div class="alert alert-success alert-dismissible" >
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Modificato!</strong>
            </div>


        </div>
    </div>
    <div class="modal fade"  id="alertEliminato"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog"  role="document">

            <div class="alert alert-success alert-dismissible"  id="alertEliminato">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Eliminato!</strong>
            </div>


        </div>
    </div>

    <div class="modal fade"  id="myModalDelete"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog"  role="document">
            <div class="modal-content" style="background-color: #fff3b1;">
                <div class="modal-header" >
                    <h5 class="modal-title" id="exampleModalLabel">Sei sicuro di voler eliminare?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer" >
                    <button type="button" onclick="setConfermaTrue(); elimina()"  class="btn btn-danger" data-dismiss="modal">Elimina</button>
                </div>
            </div>
        </div>
    </div>


@endsection


