@extends('adminlte::page')
@section('content_header')
    <h1>
        Teams &amp; Members Import
        <a href="{{ route('teams.importTemplate') }}" class="btn btn-primary float-right">Download Template</a>
    </h1>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <form method="post" action="{{ route('teams.upload') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label" for="uploadFileInput">Select File:</label>
                            <div class="col">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="uploadFile" id="uploadFileInput" accept="text/csv">
                                        <label class="custom-file-label" for="uploadFileInput">Choose File</label>
                                    </div>
                                </div>
                                @error('uploadFile')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
