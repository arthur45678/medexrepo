<div class="new-page">
    <div class="main-container">
        <div id="resuscitation-department" class="text-center">
            <strong>ՎԵՐԱԿԵՆԴԱՆԱՑՄԱՆ ԲԱԺԱՆՄՈՒՆՔ</strong>
        </div>

        @forelse($stationary->stationary_resuscitation_departments as $item)

        @php
            $classname = $it->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;
        @endphp

        <div class="{{$classname}}">
            <br><br>
            <div class="display-flex">
                    <div>Ամսաթիվ</div>
                    <div class="bottom-line">{{$item->date ?? ""}}</div>
            </div>
            <br><br>
            <div>Նկարագրություն</div>
            <p>{{$item->comment ?? ""}}</p>
            <br><br>
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
</div>