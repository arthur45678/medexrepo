@if ($label)
    <label><strong>{{$label}}</strong></label>
@endif

@if ($type === "textarea")

    <textarea name="{{$name}}" {{$form ? "form=$form" : ''}}
        {{$attributes->merge(["class" => "form-control"])}}>{{old($name, $value ?? $oldDefault)}}</textarea>
@else

    <input type="{{$type}}" name="{{$name}}" value="{{old($name, $value ?? $oldDefault)}}"
        {{$attributes->merge(["class" => "form-control"])}} {{$form ? "form=$form" : ''}} />
@endif

@if ($session())
    @error(Str::replaceFirst('[]', "", $name))
        <em class="error text-danger">{{$message}}</em>
    @enderror
@else
    <em class="error text-danger" data-input="{{$name}}"></em>
@endif
