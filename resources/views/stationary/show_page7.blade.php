<div class="new-page">
    <div class="main-container">
        <br><br>
        <div id="xray-examinations" class="text-center"><strong>ՌԵՆՏԳԵՆԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ</strong></div>
        <br><br>
        @forelse($stationary->stationary_xray_examinations as $item)

        @php
            $classname = $item->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;
        @endphp

        <div class="{{$classname}}">
            <div class="display-flex">
                <div>Ամսաթիվ</div>
                <div class="bottom-line">{{$item->examination_date ?? ""}} </div>
            </div>
            <br><br>
            <div>
                @forelse($item->attachments as $attachment)
                    <button  class="btn btn-outline-primary"><a href='{{$attachment->full_path ?? ""}}' target="_blank">View file</a></button>
                @empty

                @endforelse
            </div>
            <br />
            <p>
                {{$item->examination_comment ?? ""}}
            </p>
            <br />
            <div >
                <div class="float-left">Բժշկի Անուն Ազգանուն</div>
                <div class="bottom-line float-left">{{$item->user->full_name ?? ""}}</div>
            </div>

            <br><br><br><br>

            <br>
                <span class="print-hide">{{$item->approvementStatus()}}</span>
            <br>
            @empty

            @endforelse
        </div>
    </div>

    <div class="new-page">
        <br><br><br><br>
        <div id="cellular-examination" class="text-center"><strong>ԲՋՋԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ</strong></div>
        <br><br>

        @forelse($stationary->stationary_cellular_examinations as $item)

        {{$classname = $item->approvementStatusBoolean() == false ? 'waiting-for-approvement' : "" }}

        <div class="{{$classname}}">
            <div class="display-flex">
                <div>Ամսաթիվ</div>
                <div class="bottom-line">{{$item->examination_date ?? ""}}</div>
            </div>
            <br><br>
            @forelse($item->attachments as $attachment)
                    <button  class="btn btn-outline-primary"><a href='{{$attachment->full_path ?? ""}}' target="_blank">View file</a></button>
                @empty

                @endforelse
            <br>
            <p>{{$item->examination_comment ?? ""}}</p>
            <br>
                <span class="print-hide">{{$item->approvementStatus()}}</span>
            <br>

        </div>
        <br><br><br>
        @empty

        @endforelse
    </div>
</div>
