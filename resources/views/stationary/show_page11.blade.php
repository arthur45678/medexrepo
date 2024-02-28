<div class="new-page">
    <div class="main-container">
        <br><br>
        <div id="surgery-protocol" class="text-center"><strong> ՎԻՐԱՀԱՏՈՒԹՅԱՆ ԱՐՁԱՆԱԳՐՈՒԹՅՈՒՆ</strong></div>
        <br><br>
        @forelse($stationary->stationary_surgery_protocols as $item)

        @php
            $classname = $item->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;
        @endphp
        <div class="{{$classname}}">

            <br>
            <div class="float-left" >Ամսաթիվ</div>
            <div class="bottom-line float-left">{{$item->date ?? ""}}</div>
            <br><br>
            <div>Վիրահատության անվանումը</div>
            <p>{{$item->surgery_id ?? ""}}, {{$item->surgery_name ?? ""}}</p>
            <br>
            <div class="float-left">Սկիզբը(ժամ)</div>
            <div class="bottom-line float-left">{{$item->surgery_start ?? ""}}</div>
            <br><br>
            <div class="float-left">Ավարտ(ժամ)</div>
            <div class="bottom-line float-left">{{$item->surgery_end ?? ""}}</div>
            <br><br>
            <div class="float-left">Անզգայացումը</div>
            <div class="bottom-line float-left">{{$item->anesthesia->name ?? ""}},{{$item->medicine_item->code_name ?? ""}}</div>
            <br><br><br>
            <div class="text-center"><strong>Անզգայացման ընթացքը</strong> </div>
            <br>
            <p>{{$item->anesthesia_process ?? ""}}</p>
            <br>
            <span class="print-hide">{{$item->approvementStatus()}}</span>
            <br>
            <br>
                <span class="print-hide">{{$item->approvementStatus()}}</span>
            <br>
        </div>
        <br><br><br>
            @empty

        @endforelse
    </div>
</div>
