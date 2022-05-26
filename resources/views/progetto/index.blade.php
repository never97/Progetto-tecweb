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
                    }else{
                        alert("impossibile eliminare: revocare l'accesso ai rispettivi dipendenti");
                    }
                });

        }
    </script>
    <script src="https://code.highcharts.com/gantt/highcharts-gantt.js"></script>

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
        <h1> Progetti </h1>

        <div class="row card mt-2 p-4">
            <div class="col-12">
                <div class="row d-flex justify-content-center">

                    @if($progetti->isEmpty())
                        <p>Non ci sono progetti presenti</p>
                    @else


                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Progetto</th>
                                <th>Descrizione</th>
                                <th>Note</th>
                                <th>Inizio previsto</th>
                                <th>Fine prevista</th>
                                <th>Fine effettiva</th>
                                <th>Costo orario</th>
                                <th>Modifica</th>
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
                                    @if ($progetto->data_fine_effettiva!==null)
                                        <th scope="row">{{ date('d/m/Y', strtotime($progetto->data_fine_effettiva)) }}</th>
                                    @else
                                        <th scope="row">{{ strtotime($progetto->data_fine_effettiva)}}</th>

                                    @endif
                                    <td>{{$progetto->costo_orario}} €</td>
                                    <td><a href="{{ URL::action('App\Http\Controllers\ProgettoController@edit', $progetto) }}" ><i class="bi bi-pencil-square" style="color:#198754;"></i></a></td>
                                    <td><a onclick="elimina(event)" data-id="{{ $progetto->id }}" class="bi bi-x-lg" style="color: #dc3545;"></a></td>


                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @endif
                    <a href="{{ URL::action('App\Http\Controllers\ProgettoController@create') }}" class="float-md-right mb-2"><i class="bi bi-plus-circle-fill btn-lg" data-toggle="tooltip" title="Aggiungi"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Timeline progetti
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <div id="container1" class="card"></div>
                </div>
            </div>
        </div>

    <script>
        let progetti=<?php echo json_encode($progetti);?>;
        //console.log(progetti[0].data_inizio_prevista);
        let activities=progetti.map(function(x) {
            let start=x.data_inizio_prevista.split("T")[0].split("-")

            /*let end=x.data_fine_prevista.split("T")[0].split("-")

            if(!(x.data_fine_effettiva)){
                  end=x.data_fine_efettiva.split("T")[0].split("-")
                console.log("aaa");
            }*/
            let end;
            if(x.data_fine_effettiva){
                end=x.data_fine_effettiva.split("T")[0].split("-")
            }else{
                end=x.data_fine_prevista.split("T")[0].split("-")
            }

console.log(end);


            return {"name": x.nome,
                "start": Date.UTC(parseInt(start[0]),parseInt(start[1])-1,parseInt(start[2])),
                "end": Date.UTC(parseInt(end[0]),parseInt(end[1])-1,parseInt(end[2]))
            }
        })
        console.log(activities);

        Highcharts.setOptions({
            lang: {
                months: [
                    'Gennaio', 'Febbraio', 'Marzo', 'Aprile',
                    'Maggio', 'Giugno', 'Luglio', 'Agosto',
                    'Settembre', 'Ottobre', 'Novembre', 'Dicembre'
                ],
                weekdays: [
                    'Domenica', 'Lunedì', 'Martedì', 'Mercoledì',
                    'Giovedì', 'Venerdì', 'Sabato'
                ]
            }
        });
        //grafico
        Highcharts.ganttChart('container1', {
            xAxis: {
                min: Date.UTC(2020, 11, 31),
                max: Date.UTC(2021, 11, 31),
                gridLineWidth: 1
            },

            series: [{
                data: activities
            }]

        });
    </script>

@endsection
