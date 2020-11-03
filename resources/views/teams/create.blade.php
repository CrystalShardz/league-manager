@extends('adminlte::page')
@section('content_header')
    <h1>Create Team</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <form method="post" action="{{ route('teams.store') }}">
                <div class="card">
                    <div class="card-body">
                        @include('teams._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success" title="Create Team">
                            Create
                        </button>
                        <a href="{{ route('teams.index') }}" class="btn btn-outline-secondary float-right"
                           title="Cancel">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
