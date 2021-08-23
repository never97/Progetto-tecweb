@extends('layouts.app')

@push('scripts')
    <script>
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
                    }
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
              .then(res => {
                  if(res.status === "ok") {
                      $('#sid'+ form.get('id')+ " .data_odierna").html(formattedDate(res.data_odierna));
                      $('#sid'+ form.get('id')+ " .ore_unitarie").html(res.ore_unitarie);
                      $('#sid'+ form.get('id')+ " .note").html(res.note);
                      alert("Modificato");
                  }
              }
              );
        }
    </script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-3">
            <div class="row">
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
                        <label for="user_id">Dipendente:</label> {{ Auth::user()->cognome }}<label></label>
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="user_id"/>
                        </div>
                        <div class="form-group">
                            <label for="">Seleziona un progetto di </label> {{ Auth::user()->cognome }}<label>:</label>
                            <select class="form-control" name="progetto_id">
                                @foreach ($listaprogetti as $progetto)
                                    <option value="{{ $progetto->id }}">{{ $progetto->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="data_odierna">Data odierna: </label> {{ Carbon\Carbon::today()->format('d-m-Y') }}<label></label>

                            <input type="date" name="data_odierna" value="{{ Carbon\Carbon::today()->format('Y-m-d') }}" id="data_odierna" >
                        </div>
                        <div class="form-group">
                            <label for="note">Note</label>
                            <input type="text" name="note" class="form-control" id="note">
                        </div>

                        <div class="form-group">
                            <label for="ore_unitarie">Ore impiegate</label>
                            <input type="number" name="ore_unitarie" min="1" step="1" max="15" class="form-control" id="ore_unitarie">
                        </div>

                        <button type="submit" class="btn btn-primary">Inserisci scheda</button>
                    </form>
                </div>

            </div>
        </div>

        <div class="col-8">
            <div class="row">

                @if($schedaore->isEmpty())
                    <p>Non ci sono schede presenti</p>
                @else
                    <h1> Tutte le schede </h1>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>data_odierna</th>
                            <th>ore_unitarie</th>
                            <th>note</th>
                            <th>dipendente</th>
                            <th>progetto</th>
                            <th>azioni</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($schedaore as $schede_ore)
                            <tr id="sid{{$schede_ore->id}}">
                                <td class="data_odierna">{{ date('d/m/Y', strtotime($schede_ore->data_odierna)) }}</td>
                                <td class="ore_unitarie">{{$schede_ore->ore_unitarie}}</td>
                                <td class="note">{{$schede_ore->note}}</td>
                                <td class="user_id">{{$schede_ore->user->nome}} {{$schede_ore->user->cognome}}</td>
                                <td class="progetto_id">{{$schede_ore->progetto->nome}}</td>
                                <td><a href="#" class="btn btn-outline-danger btn-sm delete-btn" data-id="{{ $schede_ore->id }}">Elimina</a></td>
                                {{-- <td><a onclick="modifica(event)" data-id="{{$schede_ore->id}}" class="btn btn-danger">Modifica</a></td>
--}}
                               <td><a href="javascript:editscheda({{$schede_ore->id}})" class="btn btn-outline-danger btn-sm edit-btn" data-id="{{ $schede_ore->id }}">Modifica</a></td>

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
                        <form id="schedaoreForm" >
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
                                <input type="text" class="form-control" name="ore_unitarie" id="ore_unitarie1">
                            </div>
                            <button type="submit" onclick="editAsync(event)" class="btn btn-primary">Salva</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--
        <script type="text/javascript">
            $('document').ready(function(){


                $('.delete-btn').bind('click', function(e) {
                    e.preventDefault();

                    // Nota, qui $(this) è l'elemento <a> ovvero il bottone.
                    var row = $(this).parents('tr');            // Ottengo  la riga della tabella cercando fa i parents del bottone l'elemento <tr>
                    var schedaid = $(this).attr('data-id');   // Ottengo l'id della categoria andando a prelevare il valore dell'attributo "data-id"
                    var _token = $('#_token').val();            // Ottengo il token del form perchè mi serve anche per l'azione che sto per compiere

                    $.ajax({
                        url: "/schedaore/" + schedaid,     // Visto che posso configurarla usa l'azione di default per la Destroy
                        type: "DELETE",                     // Uso appunto il metodo DELETE
                        dataType: "json",
                        data: { 'schedaore': schedaid, '_token': _token }, // Passo l'id della categria e il token
                        success: function(data) {
                            if (data.status === 'ok') {
                                $(row).remove();            // Qui ho usato un semplice remove() ma potrei usare un fadeOut() o altro
                            }
                        },
                        error: function(response, stato) {
                            console.log(stato);
                        }
                    });
                });





            });

        </script>--}}

    </div>
</div>

<script>
    /*function editscheda(id){
        $.get('/schedaore/'+id, function($schede_ore){
            console.log($schede_ore);
            $("#id").val($schede_ore.id);
            $("#data_odierna1").val($schede_ore.data_odierna);
            $("#note1").val($schede_ore.note);
            $("#ore_unitarie1").val($schede_ore.ore_unitarie);
            $("#progetto_id1").val($schede_ore.progetto_id);
            $("#schedaoreModal").modal('toggle');

        })
    }*/
</script>
@endsection


