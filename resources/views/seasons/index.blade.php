@extends('adminlte::page')
@section('content_header')
    <h1>
        Seasons
        <a href="{{ route('seasons.create') }}" class="btn btn-outline-primary float-right">
            <i class="fa fa-fw fa-plus"></i> Create Season
        </a>
    </h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body m-0 p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Start</th>
                            <th>Team Count</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($seasons->count() < 1)
                            <tr>
                                <td colspan="4" class="text-center">
                                    No seasons have been created.
                                </td>
                            </tr>
                        @else
                            @foreach($seasons as $season)
                                <tr>
                                    <td>
                                        <a href="{{ route('seasons.show', [$season]) }}">
                                            {{ $season->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('seasons.show', [$season]) }}">
                                            {{ $season->datetime_start->format('jS F Y H:i') }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('seasons.show', [$season]) }}">
                                            {{ $season->teams->count() }}
                                        </a>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('seasons.destroy', [$season]) }}"
                                              data-submit="deleteSeason">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('seasons.show', [$season]) }}"
                                               class="btn btn-outline-info btn-sm" title="View">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>
                                            <a href="{{ route('seasons.edit', [$season]) }}"
                                               class="btn btn-outline-secondary btn-sm" title="Edit">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        document.querySelectorAll("[data-submit='deleteMember']").forEach((elm) => {
            elm.onsubmit = function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "This Season and all fixtures will be sent to the trash",
                    type: "question",
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonText: "Yes, Delete them"
                }).then((result) => {
                    if (result.value) {
                        e.target.submit();
                    }
                });
            };
        });
    </script>
@endpush
