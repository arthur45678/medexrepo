<div class="new-page">
    <div class="main-container">
        <div id="stationary_disease_course" class="text-center"><strong>ՀԻՎԱՆԴՈՒԹՅԱՆ ԸՆԹԱՑՔԸ</strong></div>
        <br><br>

        @forelse($stationary->stationary_disease_courses as $it)

        @php
            $classname = $it->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;
        @endphp

        <div class="{{$classname}}">
            <div class="display-flex">
                <div>Ամսաթիվ</div>
                <div class="bottom-line">{{$it->disease_course_date ?? ""}}</div>
            </div>
            <br><br><br>
            <div>Հիվանդության ընթացքը</div>
            <p>{{$it->disease_course_comment ?? ""}}</p>
            <br>
                <div>Նշանակումներ</div>
                <p>
                {{-- @forelse($stationary->stationary_prescriptions as $em) --}}
                @forelse($it->stationary_prescriptions as $em)
                    Դեղի կոդը (անունը)- {{$em->medicine_item->code_name ?? ""}} - {{ $em->medicine_dose ?? ""}}
                    {{ __('measurement_units.'.$em->measurement_unit->name) ?? ""}} <br>
                    {{$em->prescription_text}}<br><br>
                    {{ $em->user->full_name }}<br>
                    @empty

                @endforelse
                </p>
            <br>
            <div class="display-flex">
                <div>Բժիշկի անուն,ազգանուն</div>
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

