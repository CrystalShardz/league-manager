@extends("adminlte::page")
@section("content_header")
    <h1>
        Members
        <a href="{{ route("members.create") }}" class="btn btn-primary float-right">
            <i class="fa fa-fw fa-plus"></i> Create Member
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
                            <th>Team</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($members->count() < 1)
                            <tr>
                                <td colspan="4" class="text-center">
                                    No members have been created.
                                </td>
                            </tr>
                        @else
                            @foreach($members as $member)
                                <tr>
                                    <td>
                                        <a href="{{ route("members.show", [$member]) }}">
                                            {{ $member->name }}
                                        </a>
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <a href="{{ route('members.show', [$member]) }}">
                                            {{ $member->created_at->format('jS F Y') }}
                                        </a>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('members.destroy', [$member]) }}"
                                              data-submit="deleteMember">
                                            @csrf
                                            @method("DELETE")
                                            <a href="{{ route('members.show', [$member]) }}"
                                               class="btn btn-outline-info btn-sm" title="View">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>
                                            <a href="{{ route('members.edit', [$member]) }}"
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
                    text: "This member will be sent to the trash",
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
