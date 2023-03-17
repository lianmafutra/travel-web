<div class="{{ $id }} form-group">
    <label>{{ $label }}
        @if ($required == 'true')
            <span style="color: red">*</span>
        @endif
    </label>
    <input id="{{ $id }}" type="text" class="form-control input" name="{{ $id }}" placeholder=""
        value="{{ $value }}"  @if ($required == 'true') required @endif>
    <span class="text-danger error error-text {{ $id }}_err"></span>
</div>
