@extends('layouts.app')

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
                        <p>Stai guardando il giorno  </p>
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
    </div>
    </div>

@endsection


