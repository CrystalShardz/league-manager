<select name="{{ $name }}" id="{{ $id }}" class="select2 form-control"
        {{ $multiple ? ' multiple' : '' }} data-placeholder="{{ $placeholder }}">
    @foreach($teams as $team)
        <option value="{{ $team->id }}"{{ $isSelected($team->id) ? ' selected' : '' }}>{{ $team->name}}</option>
    @endforeach
</select>

@once
    @push('js')
        <script>
            $(() => {
                $('#{{ $id }}').select2({
                    tags: {{ $allowCustomTeams ? 'true' : 'false' }}
                });
            });
        </script>
    @endpush
@endonce

