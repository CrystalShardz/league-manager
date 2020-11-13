@extends('adminlte::page')
@section('content_header')
    <h1>{{ $season->name }}</h1>
@endsection
@section('content')
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
                                <td>{{ $i }}</td>
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
@endsection
