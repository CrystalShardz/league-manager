@extends('adminlte::page')
@section('content_header')
    <h1>
        {{ $season->name }}
        <div class="btn-group float-right">
            <a href="" class="btn btn-primary">
                <i class="fa fa-fw fa-plus"></i> Create Fixture
            </a>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('fixtures.generate', [$season]) }}">Generate Round Robin</a>
            </div>
        </div>
    </h1>
@endsection
@section('content')
    @if($season->fixtures()->count() < 1)
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning">
                    <p>
                        <i class="fa fa-fw fa-warning"></i> No fixtures have been created for this season.
                    </p>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                    <h3 class="card-title">Current Standings</h3>
                </div>
                <div class="card-body m-0 p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Pos</th>
                            <th>Name</th>
                            <th>Points</th>
                            <th>Win</th>
                            <th>Draw</th>
                            <th>Loss</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i = 0; $i < $season->teams->count(); $i++)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $season->teams[$i]->name }}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title">Upcoming Fixtures</h3>
                </div>
                <div class="card-body m-0 p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Home</th>
                            <th>Away</th>
                            <th>Start</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($season->fixtures()->whereDate('start_at', '>=', \Carbon\Carbon::now())->get() as $fixture)
                            <tr>
                                <td>{{ $fixture->home->name }}</td>
                                <td>{{ $fixture->away->name }}</td>
                                <td>{{ $fixture->start_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title">Pending Results</h3>
                </div>
                <div class="card-body m-0 p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Home</th>
                            <th>Away</th>
                            <th>Start</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($season->fixtures()->whereDate('start_at', '<=', \Carbon\Carbon::now())->get() as $fixture)
                            <tr>
                                <td>{{ $fixture->home->name }}</td>
                                <td>{{ $fixture->away->name }}</td>
                                <td>{{ $fixture->start_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title">Completed Fixtures</h3>
                </div>
                <div class="card-body m-0 p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Home</th>
                            <th>Away</th>
                            <th>Start</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($season->fixtures()->whereDate('start_at', '<', \Carbon\Carbon::now())->get() as $fixture)
                            <tr>
                                <td>{{ $fixture->home->name }}</td>
                                <td>{{ $fixture->away->name }}</td>
                                <td>{{ $fixture->start_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
