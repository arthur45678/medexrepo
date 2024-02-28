@php
    $health_statuses = $ambulator->health_statuses;
@endphp

<div class="new-page">
    <p></p>
        <div class="flex-container3" id="health_statuses">
            <!-- Հաճախումներ - left side -->
         

            <!-- Հիվանդի վիճակը - right side -->
            <div class="flex-item_11">
                <div id="ambulator-health-statuses" class="text-align-center">
                    <strong>Հաճախումների ամսաթիվը,<br>
                         Հիվանդի վիճակը, նշանակումները <br>
                        և բժշկի ստորագրությունը
                    </strong>
                </div>
  
                @php
                    $enum = __('measurement_units.');
                @endphp
                <p id="ambulator-prescriptions">
                    @forelse ($health_statuses as $item)
                    <strong>Ամսաթիվ</strong> - {{$item->health_status_date}} <br><br>
                    <strong>Նկարագրություն</strong> - {{$item->health_status_text ?? ""}} <br><br>
                          
                        @forelse($item->prescriptions as $em)
                        <strong>Նշանակումներ</strong> - Դեղի կոդը (անունը) - {{$em->medicine_item->code_name ?? " "}} - {{ $em->medicine_dose ?? ""}} {{__('measurement_units.'.$em->measurement_unit->name ?? "" )}} <br>
{{--                            {{ __('measurement_units.'.$em->measurement_unit->name) ?? " "}} <br>--}}
                                {{$em->prescription_text }} <br><br>
                            @empty
                        @endforelse
                        <strong>Բժշկի ստորագրությունը</strong> - {{ $em->user->full_name ?? " "}} <br><br><br>
                        @empty
                    @endforelse
                </p>
            </div>
        </div><!-- #health_statuses -->
</div>
