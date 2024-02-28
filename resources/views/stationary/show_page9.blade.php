
<div class="new-page">
    <div class="main-container">
        <div id="for_analysis" class="text-center">    
            <strong> ԱՆԱԼԻԶՆԵՐԻ ՀԱՄԱՐ</strong>
        </div>
        <br><br>

        @forelse($stationary->stationary_for_analysis as $item)

        @php
            $classname = $item->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;
        @endphp

        <div class="{{$classname}}">
            <div class="float-left">Ամսաթիվ</div>
            <div class="bottom-line float-left">{{$item->for_analysis_date ?? ""}}</div>
            <br><br>

            @forelse($item->attachments as $attachment)
                <button  class="btn btn-outline-primary"><a href='{{$attachment->full_path ?? ""}}' target="_blank">View file</a> </button>
                <br>
                <p>
                    orem Ipsum is simply
                </p>
                @empty 

            @endforelse
    
            <br>
            <br>
            <div class="float-left">Բժշկի անուն, ազգանուն</div>
            <div class="bottom-line float-left">{{$item->user->full_name ?? ""}}</div>
            <br><br>
            <br>
                <span class="print-hide">{{$item->approvementStatus()}}</span>
            <br>
        </div>
        <br><br><br>
            @empty

        @endforelse
    </div>
</div>