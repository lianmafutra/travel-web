<div class="form-group">
   <label>{{ $label }}
       @if ($required == 'true')
           <span style="color: red">*</span>
       @endif
   </label>
   <div class="input-group mb-3">
       <input id="{{ $id }}" type="number" class="form-control input" name="{{ $id }}"
           placeholder="0"  autocomplete="off"  @if ($required == 'true') required @endif>
       <span class="text-danger error error-text {{ $id }}_err"></span>
   </div>
</div>
