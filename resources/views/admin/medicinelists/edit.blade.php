
    @extends('layouts.AdminCardBase')

@section('css')
    <link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('card-header')
    <div class="card-header-actions">
        <h4>Բուժման տեսակ</h4>

    </div>

@endsection

@section('card-content')
<div class="container">
    @if(session()->has('error'))
        <strong class="alert-danger">Դեղորայքի անուներ</strong>


    @endisset
    <form method="post" action="{{route('admin.medicine-lists.update',$lists->id)}}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="code">code</label>
            <input type="text" name="code" id="code" value="{{ $lists->code }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="{{ $lists->name}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="unit">unit</label>
            <input type="text" name="unit" id="unit" value="{{ $lists->unit }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="warehouse">warehouse</label>
            <input type="text" name="warehouse" id="warehouse" value="{{ $lists->warehouse }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="name">Փոխել կարգավիճակ</label>
            <select name="status" class="form-control">
                <option value="active" @if($lists->status=="active") selected @else '' @endif>ակտիվ</option>
                <option value="inactive" @if($lists->status == "inactive") selected @else '' @endif>պասիվ</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Փոփոխել</button>
        </div>
    </form>


</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script src="{{ mix('/js/components/Select.js') }}"></script>

@endsection
