@extends('layouts.AdminCardBase')

@section('css')
{{-- <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" /> --}}
<link href="{{mix("/css/tail.select-default.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')


<div class="text-center">
    <h3>Նոր աշխատող</h3>
</div>
@endsection


@section('card-content')


<div class="container">
    <form method="post" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="form-group">
            <label for="f_name">Անուն</label>
            <input type="text" name="f_name" id="f_name" value="{{ old('f_name') }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="l_name">Ազգանուն</label>
            <input type="text" name="l_name" id="l_name" value="{{ old('l_name') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="p_name">Հայրանուն</label>
            <input type="text" name="p_name" id="p_name" value="{{ old('p_name') }}" class="form-control">
        </div>


        <div class="form-group">
            <label for="username">Լոգին</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Էլ․ հասցե</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Գաղտնաբառ</label>
            <input type="password" name="password" id="password" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="confirm-password">Հաստատել գազտնաբառը</label>
            <input type="password" name="c_password" id="confirm-password" value="" class="form-control">
        </div>

        <div class="form-group">
            <label for="departments">Բաժին</label>
            <select name="department_id" id="departments"  class="form-control with-search">
                <option value="">Ընտրել բաժինը․․․</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        @if (old('department_id') == $department->id)
                            selected='selected'
                        @endif>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="roles">Կոչում:</label>
            <x-forms.text-field type="text" name="position" value=''/>
        </div>

        <div class="form-group">
            <label for="roles">Պաշտոն:</label>
            <select name="roles[]" id="roles" multiple class="form-control with-search">
                @foreach($roles as $role)
                    <option value="{{ $role }}"
                    @if ( in_array($role, old("roles", [])) )
                        selected='selected'
                    @endif>{{ $role }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="position">Կոչումը</label>
            <input type="text" name="position" id="position" value="{{ old('position') }}" class="form-control">
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Ավելացնել</button>
        </div>
    </form>


</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
{{-- <script src="{{ mix('js/all.magicsearch.js') }}"></script> --}}
{{-- <script src="{{ mix('/js/components/Select.js') }}"></script> --}}
<script src="{{mix('/js/select-pure.js')}}"></script>

@endsection
