@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <h4>Հյուսվածքաբանական նշումներ</h4>
@endsection
@section('card-content')
    <div class="container">
        @if(session()->has('error'))
            <strong class="alert-danger">Խնդրումենք ճիշտ լրացրեք</strong>
        @endisset
        <form method="post" action="{{route('admin.histological-lists.update',$item->id)}}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Անվանում</label>
                <input type="text" name="name" id="name" value="{{ $item->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Տեսակ</label>
                <select name="code" class="form-control">
                    @foreach($codes as $code)
                        <option value="{{$code->code}}">{{$code->code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Կարգավիճակ</label>
                <select name="status" class="form-control">
                    <option value="active" @if($item->status=="active") selected @else '' @endif>ակտիվ</option>
                    <option value="inactive" @if($item->status == "inactive") selected @else '' @endif>պասիվ</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Թարմացնել</button>
            </div>
        </form>
    </div>
@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
    <script src="{{ mix('/js/components/Select.js') }}"></script>
@endsection
