@csrf
<div class="form-group row">
    <label for="teamNameInput" class="col-3 col-form-label">Name:</label>
    <div class="col">
        <input type="text" name="name" id="teamNameInput" value="{{ isset($team) ? $team->name : old('name', '') }}"
               placeholder="Team name" maxlength="100" required class="form-control">
        @error('name')
        <p class="text-danger">
            {{ $message }}
        </p>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="teamMembersInput" class="col-3 col-form-label">Members:</label>
    <div class="col">
        <x-member-selector name="members[]" id="teamMembersInput"
                           :selected="isset($team) ? $team->members : old('members', [])" multiple="true"
                           :allow-custom-members="true" placeholder="Select Members"/>
    </div>
</div>
