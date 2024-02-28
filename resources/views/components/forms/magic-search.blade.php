@php
    $form = $attributes['form'] ?? null;
@endphp

<input {{$attributes->merge(["class" => "form-control ".$class])}} data-id='{{$value}}' data-hidden="#{{$hiddenId}}"
placeholder="{{$placeholder}}" style="min-width: 100%; max-width: 100%" autocomplete="off">

<x-forms.text-field type="hidden" id='{{$hiddenId}}' name='{{$hiddenName}}' value='{{$value}}' form='{{$form}}'  />
