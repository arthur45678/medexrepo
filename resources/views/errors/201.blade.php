@extends('layouts.errorBase')

@section('content')
@php
    $headers = $exception->getHeaders();
    $goto = array_key_exists("goto",$headers) ? $headers['goto'] : null;
    $goto_text = array_key_exists("goto_text",$headers) ? $headers['goto_text'] : 'Տեսնել ավելին';
@endphp

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="clearfix">
            <h1 class="float-left display-2 mr-4">201</h1>
            <h4 class="pt-3">Ուշադրություն!</h4>
            <p class="text-muted my-2">{{ $exception->getMessage() }}</p>
            @if ($goto)

                <p class="my-2">
                    <a href="{{$goto}}" class="btn btn-primary">
                        <x-svg icon="cui-external-link" />
                        {{$goto_text}}
                    </a>
                </p>
            @endif
          </div>
          {{-- <div class="input-prepend input-group">
            <div class="input-group-prepend"><span class="input-group-text">
                <svg class="c-icon">
                  <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-magnifying-glass"></use>
                </svg></span></div>
            <input class="form-control" id="prependedInput" size="16" type="text" placeholder="What are you looking for?"><span class="input-group-append">
              <button class="btn btn-info" type="button">Search</button></span>
          </div> --}}
        </div>

      </div>
    </div>

@endsection

@section('javascript')

@endsection
