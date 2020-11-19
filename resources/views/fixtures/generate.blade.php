@extends('adminlte::page')
@section('content_header')
    <h1>Generate Fixtures</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="post" action="{{ route('fixtures.doGenerate', [$season]) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="roundsToGenerateInput" class="col-3 col-form-label">Number of Rounds:</label>
                            <div class="col">
                                <input type="number" name="roundsToGenerate" id="roundsToGenerateInput"
                                       class="form-control" min="1" value="{{ old('roundsToGenerate', 1) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Generate</button>
                        <a href="" class="btn btn-secondary float-right">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
