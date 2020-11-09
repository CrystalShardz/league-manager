@csrf
<div class="form-group row">
    <label for="memberNameInput" class="col-4 col-form-label">Name:</label>
    <div class="col">
        <input type="text" name="name" id="memberNameInput"
               value="{{ isset($member) ? $member->name : old('name', '') }}"
               placeholder="Enter member's name" maxlength="100" class="form-control" required>
        @error("name")
        <p class="text-danger">
            {{ $message }}
        </p>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="memberTeamInput" class="col-4 col-form-label">Team:</label>
    <div class="col">
        <x-team-selector name="team" id="memberTeamInput"
                         :selected="isset($member) && $member->team ? [$member->team->id] : []" allow-custom-teams="true"/>
    </div>
</div>
