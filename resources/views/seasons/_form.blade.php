@csrf
<div class="form-group row">
    <label for="seasonNameInput" class="col-3 col-form-label">Name:</label>
    <div class="col">
        <input type="text" name="name" id="seasonNameInput"
               value="{{ isset($season) ? $season->name : old('name', \App\Models\Season::getNextName()) }}"
               maxlength="100"
               class="form-control">
        @error("name")
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="seasonDateTimeStart" class="col-3 col-form-label">Start Date &amp; Time:</label>
    <div class="col">
        <div class="form-group">
            <div class="input-group date" id="seasonDateTimeStartPicker" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" name="datetime_start"
                       id="seasonDateTimeStart" value="{{ old('datetime_start', isset($season) ? $season->dateime_start->format('d/m/Y') : '') }}" data-target="#seasonDateTimeStartPicker" data-toggle="datetimepicker"/>
                <div class="input-group-append" data-target="#seasonDateTimeStartPicker" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
        @error("datetime_start")
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="seasonTeamsPicker" class="col-3 col-form-label">Teams:</label>
    <div class="col">
        <x-team-selector name="teams[]" id="seasonTeamsPicker"
                         :selected="isset($season) ? $season->teams : old('teams', [])" selectAll="true" multiple="true"/>
        @error("teams")
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>

@once
    @push('js')
        <script type="text/javascript">
            $(function () {
                $('#seasonDateTimeStartPicker').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
            });
        </script>
    @endpush
@endonce
