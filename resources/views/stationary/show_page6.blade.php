<div class="new-page">
    <br><br>
        <div id="us-endoscopy" class="text-center"><strong>ՈւԼՏՐԱՁԱՅՆԱՅԻՆ ԵՎ ԷՆԴՈՍԿՈՊԻԿ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ</strong></div>
    <br><br>
    @forelse ($stationary->stationary_ultrasound_endoscopies as $item)
    
    @php
        $classname = $item->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;
    @endphp

    <div class="{{$classname}}">
        <div class="display-flex">
            <div>Ամսաթիվ</div>
            <div class="bottom-line">{{$item->examination_date ?? ""}}</div>
        </div>
        <br><br>
        <div>
            @forelse($item->attachments as $attachment)
                <button  class="btn btn-outline-primary"><a href='{{$attachment->full_path ?? ""}}' target="_blank">View file</a> </button>
            @empty

            @endforelse

        </div>

        <br />
        <div>Նկարագրություն</div>
        <p>
            {{$item->examination_comment ?? ""}}
        </p>
        <br />
        <div class="display-flex">
            <div>Բժշկի Անուն Ազգանուն</div>
            <div class="bottom-line">{{$item->user->full_name ?? ""}}</div>
        </div>
        <br>
            <span class="print-hide">{{$item->approvementStatus()}}</span>
        <br>
    </div>
    <br><br><br>
        @empty
       
    @endforelse
       
    
</div>
