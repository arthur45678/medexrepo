
<?php
$sepis = $stationary->stationary_epicrisis;
$sepis_approvementStatusBoolean = !is_null($sepis) ? $sepis->approvementStatusBoolean() : "";
$sepis_classname = $sepis_approvementStatusBoolean === false ? 'waiting-for-approvement' : "" ;
// $classname = $stationary->stationary_epicrisis->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;
$sepis_approvementStatus = !is_null($sepis) ? $sepis->approvementStatus() : "";
?>

<div class="new-page">
    <div class="main-container">
        <br><br>

        <div class="{{$sepis_classname}}">
            <div id="epicrisis" class="text-center"><strong>ԷՊԻԿՐԻԶ</strong></div>
        </div>
        <br>
        <span class="print-hide">{{$sepis_approvementStatus}}</span>
        <br><br>
        <div class="display-flex">
            <div>Ամսաթիվ</div>
            <div class="bottom-line">{{$stationary->stationary_epicrisis->epicrisis_date ?? ""}}</div>
        </div>
        <br><br>
        @forelse($stationary->stationary_epicrisis->attachments ?? [] as $attachment)
                <button  class="btn btn-outline-primary"><a href='{{$attachment->getFullPathOsAttribute() ?? ""}}' target="_blank">View file</a> </button>
                @empty

        @endforelse
        <br><br>
        <div>Նկարագրություն</div>
        <p>{{$stationary->attending_doctor->epicrisis ?? ""}}</p>
        <br><br><br>
        <div class="display-flex">
            <div>Բուժող բժիշկ</div>
            <div class="bottom-line">{{$item->user->full_name ?? ""}}</div>
        </div>
        <br>
        <div class="display-flex">
            <div>Բաժանմունքի վարիչ</div>
            <div class="bottom-line">{{$stationary->department_head->full_name ?? ""}}</div>
        </div>
        <br>
        <div class="display-flex">
            <div>Գլխավոր բժիշկ</div>
            <div class="bottom-line">{{$stationary->stationary_epicrisis->chief_doctor->full_name ?? ""}}</div>
        </div>
    </div>
</div>
