@extends('adminlte::page')
@section('content_header')
    <h1>Create Season</h1>
@endsection
@section('content')
    <form method="post" action="{{ route('seasons.store') }}">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('seasons._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success" title="Create">
                            Create
                        </button>
                        <a href="{{ route('seasons.index') }}" class="btn btn-outline-secondary float-right"
                           title="Cancel">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
