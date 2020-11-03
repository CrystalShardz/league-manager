@extends('adminlte::page')
@section('content_header')
    <h1>
        Teams
        <a href="{{ route('teams.create') }}" class="btn btn-primary float-right">
            <i class="fa fa-fw fa-plus"></i> Create Team
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
                            <th>Captain</th>
                            <th>Joined</th>
                            <th>actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($teams->count() < 1)
                            <tr>
                                <td colspan="4" class="text-center">
                                    No teams have been created.
                                </td>
                            </tr>
                        @else
                            @foreach($teams as $team)
                                <tr>
                                    <td>
                                        <a href="{{ route('teams.show', [$team]) }}">
                                            {{ $team->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($team->captain)
                                            <a href="{{ route('members.show', [$team->captain]) }}">
                                                {{ $team->captain->name }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('teams.show', [$team]) }}">
                                            {{ $team->created_at->format('jS F Y') }}
                                        </a>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route("teams.destroy", [$team]) }}"
                                              data-submit="deleteTeam">
                                            @csrf
                                            @method("DELETE")
                                            <a href="{{ route("teams.show", [$team]) }}"
                                               class="btn btn-outline-info btn-sm" title="View">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>
                                            <a href="{{route('teams.show', [$team])}}"
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
        document.querySelectorAll("[data-submit='deleteTeam']").forEach((elm) => {
            elm.onsubmit = function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "This team will be sent to the trash",
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
