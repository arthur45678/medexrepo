{{-- incommings: $isInline = true|false, $id(for),
    $type="radio(default)"|"checkbox",
    $name, $value, $label, $oldDefault (comes from db) --}}
    {{-- @dump($check) --}}
<div class="form-check {{$variant}} mr-1">
    <input class="form-check-input" id="{{$id}}" {{$form ? "form=$form" : ''}}
    type="{{$type}}" value="{{$value}}" name="{{$name}}" {{ (old($name, $oldDefault) === $value || $check) ? 'checked' : '' }}>
    <label class="form-check-label" for="{{$id}}">{{$label}}</label>
</div>
