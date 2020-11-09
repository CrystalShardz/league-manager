@extends('adminlte::page')
@section('content_header')
    <h1>
        Locations
        <a href="{{ route('locations.create') }}" class="btn btn-primary float-right" title="Create Location">
            <i class="fa fa-fw fa-plus"></i> Create Location
        </a>
    </h1>
@endsection
@section('content')
    <div class="row">
        @foreach($locations as $location)
            <div class="col">
                <div class="card">
                    <div class="card-header with-border">
                        <h3 class="card-title">{{ $location->name }}</h3>
                    </div>
                    <div class="card-body m-0 p-0">
                        <ul class="list-group">
                            @foreach($location->children as $child)
                                <li class="list-group-item">
                                    {{ $child->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
