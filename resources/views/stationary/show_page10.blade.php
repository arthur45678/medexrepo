<div class="new-page">
    <div class="main-container">
        <div id="surgery-justification" class="text-center">
            <strong>ՎԻՐԱՀԱՏՈՒԹՅԱՆ ՀԻՄՆԱՎՈՐՈՒՄ</strong> 
        </div>
        <br><br>
        @forelse($stationary->stationary_surgery_justifications as $it)

        @php
            $classname = $it->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;
        @endphp

        <div class="{{$classname}}">
            <br><br>
            <div class="float-left">Հիվանդության պատմագիր #</div>
            <div class="bottom-line float-left">{{$it->stationary_id ?? ""}}</div>
            <div class="display-flex">
                <div class="margin-left">Ամսաթիվ</div>
                <div class="bottom-line">{{$it->date ?? ""}}</div>
            </div>
            <br><br>
            <div>Նկարագրություն</div>
            <p>{{$it->justification ?? ""}}</p>
            <br><br>
            <div class="display-flex">
            <div>Բուժող բժիշկ</div>
            <div class="bottom-line">{{$item->user->full_name ?? ""}}</div>
            </div>
            
            <br>
            <div class="display-flex">
                <div>Բաժանմունքի Վարիչ</div>
                <div class="bottom-line">{{$it->department_head->full_name ?? ""}}</div>
            </div>
            
            <br>
            <div class="display-flex">
                <div>Բուժական գծով փոխտնօրեն</div>
                <div class="bottom-line">{{$it->medical_affairs_deputy_director->full_name ?? ""}}</div>
            </div>
            <br>
                <span class="print-hide">{{$it->approvementStatus()}}</span>
            <br>
        </div>
        <br><br><br>
            @empty

        @endforelse
    </div>
</div>
 