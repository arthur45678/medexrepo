<div class="new-page">
    <div class="main-container">
        <div id="stationary_surgery_descriptions" class="text-center"><strong>ՎԻՐԱՀԱՏՈՒԹՅԱՆ ՆԿԱՐԱԳՐՈՒԹՅՈՒՆ</strong></div>
        <br><br>
        @forelse ($stationary->stationary_surgery_descriptions as $surgery_description)

        @php
            $classname = $item->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;
        @endphp

        <div class="{{$classname}}">
            <div class="display-flex">
                <div>Ամսաթիվ</div>
                <div class="bottom-line">{{$surgery_description->surgery_description_date ?? ""}}</div>
            </div>
            <br><br><br>
            <div>Նկարագրություն</div>
            <p>{{$surgery_description->surgery_description_comment ?? ""}}</p>
            <br><br>

            <div class="display-flex">
            <div>Վիրաբույժ</div>
            <div class="bottom-line">{{$surgery_description->surgeon->full_name ?? ""}} </div>
            </div>
            <br>
            <div class="display-flex">
                <div>Օգնականներ</div>
                <div class="bottom-line">{{$surgery_description->assistant->full_name ?? ""}}</div>
            </div>
            <br>
            <div class="display-flex">
                <div>Վիրաբուժական քույր</div>
                <div class="bottom-line">{{$surgery_description->surgical_sister->full_name ?? ""}} </div>
            </div>
            <br>
                <span class="print-hide">{{$item->approvementStatus()}}</span>
            <br>
        </div>
        <br><br><br>
            @empty 
            
        @endforelse
    </div> 
</div>
