<div class="form-group ">
    <label>{{ $label }}
        @if ($required == 'true')
            <span style="color: red">*</span>
        @endif
        <span class="file_info"
            style="font-size: 10px !important; color: #737373!important; font-style: italic;">
          {{ $info }} </span>
    </label>
    {{ $slot }}
    <span  class="text-danger error-text {{ $id }}_err"></span>
</div>
