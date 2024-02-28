<div class="calendar-icon-bottom {{$xpos}}">

    @if ($title)
        <span>{{$title}}</span>
    @endif

    @if ($type ==='html')
        <i class="{{$icon}} {{$iconClass}}"></i>
    @else
        <x-svg icon="{{$icon}}" class="{{$iconClass}}"/>
    @endif
</div>
