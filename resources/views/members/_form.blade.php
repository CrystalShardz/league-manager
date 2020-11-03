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
