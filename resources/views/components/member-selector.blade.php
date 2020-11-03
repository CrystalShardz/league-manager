<select name="{{ $name }}" id="{{ $id }}"
        class="select2 form-control"
        {{ $multiple ? ' multiple' : '' }} data-placeholder="{{ $placeholder }}">
    @foreach($members as $member)
        <option value="{{ $member->id }}"{{ $isSelected($member->id) ? ' selected' : '' }}>{{ $member->name }}</option>
    @endforeach
</select>

@once
    @push('js')
        <script>
            $(() => {
                $('.select2').select2({
                    tags: {{ $allowCustomMembers ? 'true' : 'false' }}
                });
            });
        </script>
    @endpush
@endonce
