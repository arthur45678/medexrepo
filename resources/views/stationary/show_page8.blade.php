
<div class="new-page">
    <div class="main-container">
        <div id="expert_advice" class="text-center">
            <strong>ՄԱՍՆԱԳԵՏՆԵՐԻ ԽՈՐՀՐԴԱՏՎՈՒԹՅՈՒՆ</strong>
        </div>
        <br><br>
        
        @forelse($stationary->stationary_expert_advice as $it)

        @php
            $classname = $it->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;
        @endphp

        <div class="{{$classname}}">
            <br><br>
            <div class="float-left">Ամսաթիվ</div>
            <div class="bottom-line float-left">{{$it->expert_advice_date ?? ""}}</div>
            <br><br>
            <p>
            {{$it->expert_advice_comment ?? ""}}
            </p>
            <br><br>
            <div class="float-left">Բժշկի անուն, ազգանուն</div>
            <div class="bottom-line float-left">{{$item->user->full_name ?? ""}}</div>
            <br><br><br>
            <br>
                <span class="print-hide">{{$it->approvementStatus()}}</span>
            <br>
            
        </div>
        <br><br><br>
            @empty 


        @endforelse
            
    </div>
</div>
