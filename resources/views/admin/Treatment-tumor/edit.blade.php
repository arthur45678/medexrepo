@extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <h4>Ծառայություն</h4>
@endsection

@section('card-content')
    <div class="container">
        @if(session()->has('error'))
            <strong class="alert-danger">Խնդրումենք ճիշտ լրացրեք</strong>
        @endisset
        <form method="post" action="{{ route('admin.tumor-treatment-list.update', [$item->id]) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Անվանում</label>
                <input type="text" name="name" id="name" value="{{ $item->name }}" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" name="price" id="price" value="{{ $item->type }}" class="form-control">
                <label for="type">Տեսակ</label>
                <select name="type" id="" class="form-control">
                    <option value="active" @if($item->status=="special_treatment") selected @else '' @endif>special_treatment</option>
                    <option value="inactive" @if($item->status == "palliative") selected @else '' @endif>palliative</option>
                    <option value="inactive" @if($item->status == "symptomatic") selected @else '' @endif>symptomatic</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Կարգավիճակ</label>
                <select name="status" class="form-control">
                    <option value="active" @if($item->status=="active") selected @else '' @endif>ակտիվ</option>
                    <option value="inactive" @if($item->status == "inactive") selected @else '' @endif>պասիվ</option>
                </select>
            </div>
            <input  name="code" type="hidden" id="code" value="{{ rand(100,1000000) }}" class="form-control">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Թարմացնել</button>
            </div>
        </form>
    </div>
@endsection

@section('javascript')
    <script>

    </script>
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
    <script src="{{ mix('/js/components/Select.js') }}"></script>
@endsection
