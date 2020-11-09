@extends('adminlte::page')
@section('content_header')
    <h1>Create Location</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="post" action="{{ route('locations.store') }}">
                    <div class="card-body">
                        @include('locations._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Create</button>
                        <a href="{{ route('locations.index') }}"
                           class="btn btn-outline-secondary float-right">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
