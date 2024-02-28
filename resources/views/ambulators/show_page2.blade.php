<div class="new-page">
    <p></p>
    <div class="flex-container2">
        <div class="flex-item_1">
            <div id="ambulator-complaints" class="text-align-center">
                <strong> Երկվորյակ է հիվանդը թէ ոչ<br>
                    <span>{{$ambulator->is_a_twin == 0 ? '(Ոչ)' : '(Այո)'}}</span>
                     
                </strong>
                
            </div>
            <p>
                @forelse ($ambulator->complaints as $item)
                <strong>Ամսաթիվը</strong> - {{$item->complaint_date ?? ""}} <br><br>
                <strong>Հիվանդի գանգատները</strong> - {{$item->complaint_text ?? ""}} <br><br>
                <strong>Բժշկի ստորագրություն</strong> - {{$item->user->full_name ?? ""}}<br>
                    @empty

                @endforelse
            </p>
        </div>
        <div class="flex-item_2">
            <div id="last_disease" class="text-align-center">
                <strong> Ինչ հիվանդությունով է<br>
                    հիվանդացել
                </strong>
            </div>
            <p>
                @php
                    $previous_diagnoses = $ambulator->previous_diagnoses();
                @endphp
                @forelse ($previous_diagnoses as $item)
                    <strong>Ախտորոշում</strong> - 
                    {{$item->disease_item->code ?? ""}} - {{$item->disease_item->name ?? ""}} <br><br>
                    <strong>Ամսաթիվ</strong> - 
                    {{$item->diagnosis_date ?? ""}} <br><br>
                    <strong>Լրացում</strong> - 
                    {{$item->diagnosis_comment ?? ""}} <br><br>
                    <strong>Բժշկի ստորագրություն</strong> - 
                    {{$item->user->full_name ?? ""}} <br>
                @empty
                @endforelse
            </p>
        </div>
        <div id="ambulator-female-issues" class="flex-item_3">
            <strong>Ծննդաբերության թիվը</strong><span>{{optional(optional($ambulator->female_issues))->number_of_births}}</span>
            <p></p>
            <strong>Վիժումների թիվը</strong><span>{{optional(optional($ambulator->female_issues))->number_of_abortions}}</span>
            <p></p>
            <strong>Վերջին ծննդաբերությունը</strong>
            <p>{{optional(optional($ambulator->female_issues))->date_of_last_birth}}</p>
            <strong>Բարդությունները կրծքով կերակրման շրջանում</strong>
            <p>{{optional(optional($ambulator->female_issues))->breastfeeding_complications}}</p>
            <strong>Կրծքագեղձի բորբոքում</strong>
            <p>{{optional(optional($ambulator->female_issues))->breast_inflammation}}</p>
            <strong>Դաշտանը</strong>
            <p> 
                <strong>Ամսաթիվ</strong> - {{optional(optional($ambulator->female_issues))->menstruation_date}} <br><br>  
                <strong>Նկարագրությունը</strong> - {{optional(optional($ambulator->female_issues))->menstruation}} 
            </p>
        </div>
    </div>
</div>

<br>
<div class="page-wrap">
    <div class="new-page">
        <p></p>
        <div class="flex-container2">
            <div class="flex-item_4" id="ambulator-onset-and-developments">
            <div class="text-align-center">
                <strong>Ուռուցքի նկարագրությունը    <br>
                    և նրա տեղակայումը
                </strong>
            </div>
            <p>
                @forelse ($ambulator->tumor_infos as $item)
                    <br>
                    <strong>Ամսաթիվը</strong> - {{$item['tumor_date'] ?? ""}}  <br> <br>
                    <strong>Նկարագրությունը</strong> - {{$item['tumor_description'] ?? ""}} <br><br>
                    <strong>Բժշկի ստորագրություն</strong> - {{$item->user->full_name ?? ""}}
                    @empty

                @endforelse
            </p>
            <div id="" class="text-align-center">
                <strong>Բջջաբանական և հյուսվածքաբանական<br>
                    հետազոտություններ
                </strong>
            </div>
            <p>
                <strong>Բջջաբանական </strong> <br><br>
                @foreach ($histological as $item)
                <strong> Ամսաթիվ </strong> -{{$item->examination_date}} <br>
                <strong> Նկարագրություն </strong>{{$item->examination}} <br><br>
                @endforeach
                <br>

                <strong>Հյուսվածքաբանական </strong> <br><br>
                @foreach ($cellular as $item)
                <strong> Ամսաթիվ </strong> -{{$item->examination_date}} <br>
                <strong> Նկարագրություն </strong>{{$item->examination_comment}} <br><br>
                @endforeach
                <br>
                
            </p>
            </div>
            <div class="flex-item_5" id="ambulator-tumor-infos">
            <div class="text-align-center">
                <strong> Տվյալ հիվանդության հանդես գալը<br>
                    և նրա զարգացումը
                </strong>
            </div>
            <p>
                @forelse ($ambulator->onset_and_developments as $item)
                    <br>
                    <strong>Ամսաթիվը</strong> - {{ $item->oad_date ?? ""}}<br><br>
                    <strong>Նկարագրությունը</strong> -{{ $item->oad_comment ?? ""}}<br><br>
                    <strong>Բժշկի ստորագրություն</strong> -{{ $item->user->full_name ?? ""}} <br>
                    @empty

                @endforelse
            </p>
            </div>
            <br>
        </div>
    </div>
</div>
