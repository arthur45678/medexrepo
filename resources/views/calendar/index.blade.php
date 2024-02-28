@extends('layouts.base')

@section('css')


   <link rel="stylesheet" href="{{asset('assets/calendar/css/evo-calendar.css')}}" />

@endsection
@section('content')
    <div id="calendar"></div>

    <div class="modal">
        <div class="block">
            <span class="iks">&times;</span>
            <form action="{{route('calendarstore')}}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="@if(isset($user_id)) {{$user_id}} @else {{auth()->id()}}@endif">
                <input type="hidden" id="datehidden" name="date">
            <div>
                <label for="anun">Վերնագիր</label>
                <input id="anun" name="name" />
            </div>
                <br>
            <div>
                <label for="carti_hamar">ՀԾՀՀ</label>
                <input id="carti_hamar" name="soc" />
            </div>
                <br>
            <div class="amsativ">
                <label for="start_jam">Մեկնարկի ժամանակը</label>
                <input type="time" name="start" id="start_jam" />
{{--                <div class=cover></div>--}}
            </div>
                <br>
            <div class="amsativ">
                <label for="end_jam">Ավարտի ժամանակը</label>
                <input type="time" name="end" id="end_jam" />
{{--                <div class=cover></div>--}}
            </div>
                <br>
            <div>
                <label for="description">Նպատակը</label>
                <textarea id="description" name="description"></textarea>
                <input type="hidden" name="id" id="hid_id" />
            </div>
            <div class="send">
                <button class="send" type="submit" disabled>Ավելացնել</button>
            </div>
            </form>

        </div>
    </div>




@endsection

@section('javascript')
    <script>
        let user_id= @if(isset($user_id)) {{$user_id}} @else {{auth()->id()}}@endif;

        var auth_man_type ='true';
        @isset($auth_man)
            auth_man_type = {{$auth_man}}
        @endisset
        console.log(auth_man_type)
    </script>
    <script >

        function save(data) {
            var token = $("input[name='_token']").val();
            var url = "{{route('calendarfind')}}";
            var method='post';
            fetchsend(token, url,method, data,'htmltype');
        }
        function addCalendar(data) {


            var token = $("input[name='_token']").val();
            var url = "{{route('calendarstore')}}";
            var method='post';

        }
            var todayData= @json($list);
            var all = @json($all);


    </script>
    {{--<script src="{{ mix('js/jquery.js?id=askjb') }}"></script>--}}
    <script  defer src="{{mix('assets/calendar/js/my-calendar.js')}}"></script>
    <script defer src="{{mix('assets/calendar/js/evo-calendar.js')}}"></script>
    {{--<script src="{{asset('assets/calendar/js/jquery-3.5.1.min.js')}}"></script>--}}
    {{--<script src="/assets/calendar/js/jquery-3.5.1.min.js'"></script>--}}
    <script src="{{ mix('js/jquery.js') }}"></script>

@endsection
