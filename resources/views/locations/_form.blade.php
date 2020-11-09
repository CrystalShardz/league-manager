@csrf
<div class="form-group row">
    <label class="col-3 col-form-label" for="locationNameInput">Name:</label>
    <div class="col">
        <input type="text" name="name" id="locationNameInput" class="form-control" maxlength="100" required/>
    </div>
</div>
<div class="form-group row">
    <label class="col-3 col-form-label" for="locationParentInput">Parent:</label>
    <div class="col">
        <select name="parent" id="locationParentInput" class="select2 form-control">
            @if(!isset($location))
                <option value="" selected disabled>Select Parent</option>
            @endif
            @foreach($locations as $_location)
                <option value="{{ $_location->id }}"
                        @if(isset($location) && $location->parent && $location->parent->id == $_location->id) selected @endif>{{ $_location->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-3 col-form-label" for="locationChildrenInput">Children:</label>
    <div class="col">
        <select name="children[]" id="locationChildrenInput" class="select2 form-control"
                data-placeholder="Select Children" data-tags="true" multiple>
            @foreach($locations as $_location)
                @if(isset($location) && $_location->parent->id == $location->id)
                    <option id="{{ $_location->id }}" selected>{{ $_location->name }}</option>
                @else
                    <option id="{{ $_location->id }}">{{ $_location->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
@once
    @push('js')
        <script type="text/javascript">
            $(function () {
                $('.select2').select2();
            });
        </script>
    @endpush
@endonce
