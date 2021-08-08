@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-3">
            <div class="row">
                <div class="card w-100 p-2">
                    <form>
                        <div class="form-group">
                            <label for="data_odiera">Data odierna</label>
                            <input type="date" class="form-control" id="data_odierna">
                        </div>
                        <div class="form-group">
                            <label for="progetto">Progetto</label>
                        </div>
                        <div class="form-group">
                            <label for="ore">Ore impiegate</label>
                            <input type="number" min="1" step="1" class="form-control" id="ore">
                        </div>
                        <button type="submit" class="btn btn-primary">Inserisci scheda</button>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-8">
            <div class="row">
                @forelse ($schedaore as $scheda)
                <li>{{ $scheda->note}}</li>
                @empty
                <p>No scheda ore</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection