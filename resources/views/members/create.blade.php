@extends('adminlte::page')
@section('content_header')
    <h1>Create Member</h1>
@endsection
@section('content')
    <form method="post" action="{{ route('members.store') }}" class="form-horizontal">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('members._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success" title="Create Member">
                            Create
                        </button>
                        <a href="{{ route('members.index') }}" class="btn btn-outline-secondary float-right"
                           title="Cancel">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
