@extends('layouts.app')
@push('scripts')
    <script src="https://code.highcharts.com/highcharts.src.js"></script>

@endpush
@section('content')
    <div class="container-fluid">
        <div class="row card mt-2 p-4 justify-center">
            <div class="col-10 offset-1">






                <div class="accordion" id="accordionCliente">
                    <div class="card ">
                        <div class="card-header" id="headingCliente">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseCliente" aria-expanded="true" aria-controls="collapseCliente">
                                    Ore spese su ogni progetto
                                </button>
                            </h2>
                        </div>
                        <div id="collapseCliente" class="collapse show" aria-labelledby="headingCliente" data-parent="#accordionCliente">
                            <div class="card-body ">
                                @if($statistiche->isEmpty())
                                    <div class="row d-flex justify-content-center">
                                        <p>Non ci sono schede presenti</p>
                                    </div>
                                @else

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Nome progetto</th>
                                            <th>Ore unitarie</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($statistiche as $dipendenteSemplice)
                                            <tr>
                                                <td class="somma">{{$dipendenteSemplice->progetto}}</td>
                                                <td class="somma">{{$dipendenteSemplice->totale}}</td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>

                        @endif
                    </div>
                </div>
                <div class="accordion" id="accordionStraord">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseStraord" aria-expanded="true" aria-controls="collapseStraord">
                                    Straordinari
                                </button>
                            </h2>
                        </div>
                        <div id="collapseStraord" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionStraord">
                            <div class="card-body">
                                <form method="GET" action="{{action('App\Http\Controllers\SchedaOreController@filterStat')}}">
                                    <div class="form-row d-flex justify-content-center p-2">
                                        <div class="col-2">
                                            <input type="date" class="form-control" name="data_check" required value="{{$data_check}}">
                                        </div>
                                        <input type="submit" class="btn btn-info" value="Cerca"/>
                                    </div>
                                </form>


                                <div class="row d-flex justify-content-center">
                                    <p>Stai guardando il giorno  '{{date('d-m-Y', strtotime($data_check))}}'</p>
                                </div>
                                @if($straordinari->isEmpty())
                                    <div class="row d-flex justify-content-center">

                                        <p>Non sono presenti straordinari nella data selezionata</p>
                                    </div>
                                @else




                                    <h1> Straordinari</h1>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Ore extra lavorative</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($straordinari as $dipendenteSemplice)
                                            <tr>
                                                <td class="somma">{{date('d-m-Y', strtotime($dipendenteSemplice->data_odierna))}}</td>
                                                <td class="somma">{{$dipendenteSemplice->straordinari}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>

                        @endif
                    </div>

                </div>

            <div class="accordion" id="accordionCalendario">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseCalendario" aria-expanded="true" aria-controls="collapseCalendario">
                                Calendario
                            </button>
                        </h2>
                    </div>
                    <div id="collapseCalendario" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionCalendario">
                        <div class="card-body">
                            <form method="GET" action="{{action('App\Http\Controllers\SchedaOreController@filterStat')}}">
                                <div class="form-row d-flex justify-content-center">
                                    <div class="col-2">

                                        <select id="inputState" class="form-control" name="mese" onchange="this.form.submit();">
                                            <option selected>scegli il mese</option>
                                            <option value="Gennaio">Gennaio</option>
                                            <option value="Febbraio">Febbraio</option>
                                            <option value="Marzo">Marzo</option>
                                            <option value="Aprile">Aprile</option>
                                            <option value="Maggio">Maggio</option>
                                            <option value="Giugno">Giugno</option>
                                            <option value="Luglio">Luglio</option>
                                            <option value="Agosto">Agosto</option>
                                            <option value="Settembre" id="Settembre">Settembre</option>
                                            <option value="Ottobre">Ottobre</option>
                                            <option value="Novembre">Novembre</option>
                                            <option value="Dicembre">Dicembre</option>

                                        </select>
                                    </div>
                                </div>
                            </form>

                            <div class="row justify-content-center p-4">

                                @if($calendario->isEmpty())
                                    <p>Non sono presenti attività per questo mese</p>
                                @else
                                    <p>Attività relative al mese di {{$mese}}</p>

                            </div>






                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Ore</th>
                                    <th>Note</th>
                                    <th>Progetto di riferimento</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($calendario as $calendar)
                                    <tr>
                                        <td class="somma">{{date('d-m-Y', strtotime($calendar->data_odierna))}}</td>
                                        <td class="somma">{{$calendar->ore_unitarie}}</td>
                                        <td class="somma">{{$calendar->note}}</td>
                                        <td class="somma">{{$calendar->nome}}</td>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--  </div>
                              </div>--}}
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="container_grafico"></div>



    </div>
    <script>

        var datas={{json_encode($datas)}}

        Highcharts.chart('container_grafico',{
            title:{
                text:"Progetti a cui hai lavorato"
            },
            xAxis:{
                categories: ['Gennaio','Febbraio','Marzo','Aprile','Maggio', 'Giugno', 'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre']
            },
            yAxis:{
                title:{
                    text:"Numero Attività svolte"
                }
            },
            plotOptions:{
                series:{
                    allowPointSelect:true
                }
            },
            series:[{
                name:'progetti',
                data:datas
            }],
            responsive:{
                rules:[
                    {
                        condition:{
                            maxWidth:500
                        },
                        chartOptions:{
                            legend:{
                                layout:'horizontal',
                                align:'center',
                                verticalAlign:'bottom'
                            }
                        }
                    }
                ]
            }
        });

    </script>
@endsection
CIAO

