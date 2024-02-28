<div class="new-page">    
    <div class="main-container">   
        <br><br>
        <div id="stationary_special_note" class="text-center"><strong> ՀԱՏՈՒԿ ՆՇՈՒՄՆԵՐ</strong></div>
        <br><br>
        @forelse($stationary->stationary_special_note as $it)
        
        @php
            $classname = $it->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;
        @endphp

        <div class="{{$classname}}">
            <div class="display-flex">
                <div>Ամսաթիվ</div>
            <div class="bottom-line">{{$it->special_note_date ?? ""}}</div>
            </div>
            <br><br>
            @forelse($it->attachments as $attachment)
                <button  class="btn btn-outline-primary"><a href='{{$attachment->full_path ?? ""}}' target="_blank">View file</a> </button>
                @empty 

            @endforelse
            <br><br>
            <p>{{$it->special_note_comment ?? ""}}</p>
            <br><br>
            <div class="display-flex">
                <div>Բժշկի Անուն Ազգանուն</div>
                <div class="bottom-line">{{$item->user->full_name ?? ""}}</div>
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