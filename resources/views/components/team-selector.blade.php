<div class="input-group">
    <select name="{{ $name }}" id="{{ $id }}" class="select2 form-control"
            {{ $multiple ? ' multiple' : '' }} data-placeholder="{{ $placeholder }}">
        @foreach($teams as $team)
            <option value="{{ $team->id }}"{{ $isSelected($team->id) ? ' selected' : '' }}>{{ $team->name}}</option>
        @endforeach
    </select>
    @if($selectAll)
    <div class="input-group-append">
        <button type="button" class="btn btn-outline-secondary" data-toggle="selectAll" data-target="#{{ $id }}">
            Select All
        </button>
    </div>
        @endif
</div>

@once
    @push('js')
        <script type="text/javascript">
            $(function() {
                $('#{{ $id }}').select2({
                    tags: {{ $allowCustomTeams ? 'true' : 'false' }}
                });
                $('[data-toggle="selectAll"]').click(function() {
                    let target = $($(this).data('target'));
                    target.find('option').each(function() {
                        $(this).prop('selected', !$(this).selected);
                    });

                    target.trigger('change');
                });
            });
        </script>
    @endpush
@endonce

