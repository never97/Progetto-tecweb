@extends('layouts.app')
    @push('scripts')

    @endpush
@section('content')
    <div class="container">
        <div class="row justify-content-between">

            <div class="col-8">



                @if($statistiche->isEmpty())
                    <p>Non ci sono schede presenti</p>
                @else

                    <p>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseClienti" aria-expanded="false" aria-controls="collapseExample">
                            Mostra le ore spese per ogni cliente
                        </button>
                    </p>

                    <div class="collapse" id="collapseClienti">
                        <div class="card card-body">
                            <h1> Ore spese su ogni progetto di {{Auth::user()->nome}} {{Auth::user()->cognome}}</h1>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nome cliente</th>
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

                <p>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseStraordinari" aria-expanded="false" aria-controls="collapseExample">
                        Mostra gli straordinari
                    </button>
                </p>
                <div class="collapse" id="collapseStraordinari">
                    <div class="card card-body">
                        <div class="row mb-2">
                            <form method="GET" action="{{action('App\Http\Controllers\SchedaOreController@filterStat')}}">
                                <div class="form-row">
                                    <div class="col">
                                        <input type="date" class="form-control" name="data_check" required value="{{$data_check}}">
                                    </div>
                                    <input type="submit" class="btn btn-info" value="Cerca"/>
                                    <a href="statistiche" class="btn btn-info">indietro</a>
                                </div>
                            </form>
                        </div>

                        <div class="row">
                            <p>Stai guardando il giorno  {{$data_check}}</p>
                        </div>
                        @if($straordinari->isEmpty())
                            <p>Non ci sono schede presenti</p>
                        @else




                            <h1> Straordinari</h1>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nome cliente</th>
                                    <th>Ore extra lavorative</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($straordinari as $dipendenteSemplice)
                                    <tr>
                                        <td class="somma">{{$dipendenteSemplice->nome}}</td>
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
        {{-- <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseCalendario" aria-expanded="false" aria-controls="collapseExample">
                Mostra il calendario mensile
            </button>
        </p>--}}
        {{-- <div class="collapse" id="collapseCalendario">
            <div class="card card-body">
            --}}
        <div class="row mb-2">
            <form method="GET" action="{{action('App\Http\Controllers\SchedaOreController@filterStat')}}">
                <div class="form-row">
                    <label for="inputState">Calendario</label>
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

                    </select><a href="statistiche" class="btn btn-info">indietro</a>
                    <button type="reset">reset</button>
                </div>
            </form>
        </div>

        <div class="row">
            {{-- @if ($mese=="01")
                <p>Attività relative al mese di Gennaio</p>
            @elseif ($mese=="02")
                <p>Attività relative al mese di Febbraio</p>
            @elseif ($mese=="03")
                <p>Attività relative al mese di Marzo</p>
            @elseif ($mese=="04")
                <p>Attività relative al mese di Aprile</p>
            @elseif ($mese=="05")
                <p>Attività relative al mese di Maggio</p>
            @elseif ($mese=="06")
                <p>Attività relative al mese di Giugno</p>
            @elseif ($mese=="07")
                <p>Attività relative al mese di Luglio</p>
            @elseif ($mese=="08")
                <p>Attività relative al mese di Agosto</p>
            @elseif ($mese=="09")
                <p>Attività relative al mese di Settembre</p>
            @elseif ($mese=="10")
                <p>Attività relative al mese di Ottobre</p>
            @elseif ($mese=="11")
                <p>Attività relative al mese di Novembre</p>
            @elseif ($mese=="12")
                <p>Attività relative al mese di Dicembre</p>


            @endif--}}
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
                    <td class="somma">{{$calendar->data_odierna}}</td>
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

        <div id="container_grafico"></div>

    </div>
    </div>


    </div>
    <script>

        var datas=<?php echo json_encode($datas)?>

        Highcharts.chart('container_grafico',{
            title:{
                text:"Progetti a cui hai lavorato"
            },
            xAxis:{
                categories: ['gennaio','Febbraio','Marzo','Aprile','Maggio', 'Giugno', 'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre']
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


