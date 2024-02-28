@extends('layouts.cardBase')

@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet"/>
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Բժշ․ օգնության ծավալների հաշվառման ձև 0001</h3>
</div>
@endsection


@section('card-content')

    <div class="container">
        <form action="{{route('samples.patients.medical-care-accounting1.store',$patient->id)}}" class="ajax-submitable"  method="POST">
            @csrf

                <ol class="list-group">
                    <li class="list-group-item">
                        <strong>Դեպքի կարգավիճակ </strong>
                        <div class="form-row mt-2 px-1">
                            <div class="col-md-4">
                                <select class="form-control" name="case_status">
                                    <option value="free">Պետ Պատվեր</option>
                                    <option value="paid">Պետ պատվեր (վճարովի)</option>
                                </select>
                                <em class="error text-danger" data-input="case_status"></em>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">1.</span>
                            Ուղեգիր համար N
                        </strong>
                        <div class="my-2">
                            <x-forms.text-field type="number" name="tickets_N" placeholder="համար N․"
                                                class="mt-2"
                                                value="" label=""/>
                            <em class="error text-danger" data-input="tickets_N"></em>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">2.</span>
                            Ուղեգրող բժշկական հաստատության անվանումը, կոդը

                        </strong>
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" value='' hidden-id="clinic_id"
                                                  validationType="ajax"
                                                  hidden-name="clinic_id" data-catalog-name="clinics"
                                                  placeholder="ընտրել բաժանմունքը․․․"/>
                            <em class="error text-danger" data-input="clinic_id"></em>

                        </div>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="clinic_comments"
                                                placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                                value="" label=""/>
                        </div>
                    </li>


                        <li class="list-group-item">
                            <div class="form-row align-items-center">
                                <strong>
                                    <span class="badge badge-light mr-1">3.</span>
                                    Ուղեգրման ամսաթիվը

                                </strong>
                                <br>
                                <div class="col-md-8">
                                    <x-forms.text-field name="date" validationType="ajax" type="date"
                                                        value="" label="" />
                                    @error('date')
                                    <em class="error text-danger">Կենսանյութը վերցնելու ամսաթիվ դաշտը պարտադիր է։</em>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-row align-items-center">
                                <strong>
                                    <span class="badge badge-light mr-1">4.</span>
                                    C

                                </strong>
                                <br>
                                <br>
                                <div class="col-md-8">
                                    <x-forms.text-field name="c" validationType="ajax" type="number"
                                                        value="" label="" placeholder="համար N․"/>
                                    @error('c')
                                    <em class="error text-danger">Կենսանյութը վերցնելու ամսաթիվ դաշտը պարտադիր է։</em>
                                    @enderror
                                </div>
                            </div>
                        </li>


                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">6.</span>
                            Ուղեգրող այլ հաստատություններ

                        </strong>
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" value='' hidden-id="clinic2_id"
                                                  validationType="ajax"
                                                  hidden-name="clinic2_id" data-catalog-name="clinics"
                                                  placeholder="ընտրել բաժանմունքը․․․"/>
                            <em class="error text-danger" data-input="clinic2_id"></em>

                        </div>
                    </li>


                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">7.</span>
                            Ուղեգրի, գրության համարը N
                        </strong>
                        <div class="my-2">
                            <x-forms.text-field type="number" name="referral_N" placeholder="լրացման ազատ դաշտ․․․"
                                                class="mt-2"
                                                value="" label=""/>
                            <em class="error text-danger" data-input="referral_N"></em>
                        </div>
                    </li>


                   <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">12.</span>
                            Հիվանդի անուն, ազգանունը
                        </strong>
                        {{$patient->full_name}} {{$patient->p_name}}
                    </li>
                   <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">18.</span>
                            Սոց․ կամ հատուկ խմբի կոդը, փաստաթղթի համարը N

                        </strong>
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax my-2" data-catalog-name="social_packages"
                                                  hidden-id="social_package_id" hidden-name="social_package_id" autocomplete="off"
                                                  placeholder="Ընտրել սոցիալական խումբը․․․" />
                            <em class="error text-danger" data-input="department_id"></em>
                        </div>
                        <div class="my-2">
                            <x-forms.text-field type="number" name="social_package_comments" placeholder="համարը N․"
                                                class="mt-2"
                                                value="" label=""/>
                        </div>

                    </li>

                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">20.</span>
                            Հաշվետվության համարը N
                        </strong>
                        <div class="my-2">
                            <x-forms.text-field type="number" name="ReportNumberN" placeholder="համարը N"
                                                class="mt-2"
                                                value="" label=""/>
                            <em class="error text-danger" data-input="ReportNumberN"></em>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">21.</span>
                            Հոսպիտալացման բաժանմունքի համարը N
                        </strong>
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" value='' hidden-id="hospital_department_id"
                                                  validationType="ajax"
                                                  hidden-name="hospital_department_id" data-catalog-name="departments"
                                                  placeholder="ընտրել բաժանմունքը․․․"/>

                            <em class="error text-danger" data-input="hospital_department_id"></em>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">22.</span>
                            Մատուցված ծառայության տեսակը մ/օր
                        </strong>
                        <div class="container service-wrap-gg-row">
                            <strong>ծառայություն</strong>
                            <x-forms.magic-search hidden-name="service_id" hidden-id="service_id"
                                                  placeholder="Ընտրել ծառայությունը․․․" class="my-2"
                                                  id="service_search_" autocomplete="off"/>
                            <em class="error text-danger" data-input="service_id"></em>

                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">23.</span>
                            Պետպատվերի հոդվածը
                        </strong>
                        <div class="col-md-4">
                            <select class="form-control" name="scholarships_id">
                                @foreach($scholarships as $scholarship)
                                <option value="{{$scholarship->id}}">{{$scholarship->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                   <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">24.</span>
                            Հիմնական կլինիկական եզրափակիչ ախտորոշումը
                        </strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="field_comments" placeholder="լրացման ազատ դաշտ․․․"
                                                class="mt-2"
                                                value="" label=""/>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">25.</span>
                            Տեղափոխված է (բաժանմունքի անվանումը)
                        </strong>
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" value='' hidden-id="moved_department_id"
                                                  validationType="ajax"
                                                  hidden-name="moved_department_id" data-catalog-name="departments"
                                                  placeholder="ընտրել բաժանմունքը․․․"/>

                            <em class="error text-danger" data-input="moved_department_id"></em>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">26.</span>
                            Մատուցված ծառայության տեսակը մ/օր
                        </strong>

                        <div class="container service-wrap-gg-row">
                            <strong>ծառայություն</strong>
                            <x-forms.magic-search hidden-name="service2_id" hidden-id="service2_id"
                                                  placeholder="Ընտրել ծառայությունը․․․" class="my-2"
                                                  id="service_search_2" autocomplete="off"/>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">27.</span>
                            Պետպատվերի հոդվածը
                        </strong>
                        <div class="col-md-4">
                            <select class="form-control" name="scholarships2_id">
                                @foreach($scholarships as $scholarship)
                                    <option value="{{$scholarship->id}}">{{$scholarship->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                   <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">28.</span>
                            Տեղափոխված է (բաժանմունքի անվանումը)
                        </strong>
                        <div class="my-2">
                            <x-forms.magic-search class="magic-search ajax" value='' hidden-id="moved_department2_id"
                                                  validationType="ajax"
                                                  hidden-name="moved_department2_id" data-catalog-name="departments"
                                                  placeholder="ընտրել բաժանմունքը․․․"/>

                            <em class="error text-danger" data-input="moved_department_id"></em>
                        </div>
                    </li>
               <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">29.</span>
                            Մատուցված ծառայության տեսակը մ/օր
                        </strong>

                        <div class="container service-wrap-gg-row">
                            <strong>ծառայություն</strong>
                            <x-forms.magic-search hidden-name="service3_id" hidden-id="service3_id"
                                                  placeholder="Ընտրել ծառայությունը․․․" class="my-2"
                                                  id="service_search_2" autocomplete="off"/>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">30.</span>
                            Պետպատվերի հոդվածը
                        </strong>
                        <div class="col-md-4">
                            <select class="form-control" name="scholarships3_id">
                                @foreach($scholarships as $scholarship)
                                    <option value="{{$scholarship->id}}">{{$scholarship->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>


                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">31.</span>
                            Համալրման տեսակը
                        </strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="replenishment_type" placeholder="լրացման ազատ դաշտ․․․"
                                                class="mt-2"
                                                value="" label=""/>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">32.</span>
                            Համալրման չափը
                        </strong>
                        <div class="my-2">
                            <x-forms.text-field type="textarea" name="replenishment_size" placeholder="լրացման ազատ դաշտ․․․"
                                                class="mt-2"
                                                value="" label=""/>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <h4 class="text-center">Օգտագործված դեղ և բժշկական նշանակության ապրանքներ</հ4>
                    </li>

                <?php $source= [
                        "a" => "Պետ պատվեր" ,
                        "b" => "Վճարովի" ,
                        "c" => "Հիվանդի կողմից" ,
                        "d" => "Հումանիտար օգնություն"
                    ];
                     ?>

                    <li class="list-group-item">

                        <strong>
                            <span class="badge badge-light mr-1">36.</span>
                            Աղբյուր, Անվանումը,դեղաձևը
                            դեղաչափը և թողարկման ձևը
                            (փաթեթավորումը)
                        </strong>
                        <x-forms.add-reduce-button type="add" data-row=".care-medicine-row" />
                        <x-forms.add-reduce-button type="reduce" data-row=".care-medicine-row" />
                        <x-forms.hidden-counter class="stationary-prescription-rows" name="care_medicine_length" />

                        @for($i = 0; $i < $repeatables; $i++)
                            <div class="care-medicine-row {{ $i < old('care_medicine_length', 1) ? ' ' : 'd-none' }}">

                          <div class="axpyur_row ">
                                 <hr class="mb-2">
                                 <select class="form-control" name="source_id[]">
                                 <option value="a">Պետ պատվեր</option>
                                 <option value="b">Վճարովի</option>
                                 <option value="c">Հիվանդի կողմից</option>
                                 <option value="d">Հումանիտար օգնություն</option>

                                 </select>

                          </div>
                                <br>

                     <x-forms.magic-search class="medicines-search magic-search ajax form-control care_medicine_id{{$i}}"

                                                          data-catalog-name="medicines"
                                                          value='{{ old("care_medicine_id.$i") }}'
                                                          hidden-id="care_medicine_id{{ $i }}"
                                                          hidden-name="care_medicine_id[]"
                                                          placeholder="Ընտրել դեղամիջոցը․․" />
                                <style>
                                    .care_medicine_id{{$i}}{
                                        width: 700px!important;
                                        display: block;!important;
                                    }
                                </style>
                                <hr class="hr-dashed">
                                <div class="my-2">
                                    <x-forms.text-field type="textarea" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                                        value='{{ old("care_text.$i") }}' name="care_text[]"
                                                        validationType="ajax" label="" />
                                </div>

                                    <strong>Քանակ՝</strong>
                                    <x-forms.text-field type="number" name='medicine_dose[]' label=""
                                                        value='{{ old("medicine_dose.$i") }}' validationType="ajax" />
                                <hr class="mb-2">
                            </div>
                        @endfor

                    </li>

                    <li class="list-group-item">
                        <strong>
                            <span class="badge badge-light mr-1">37.</span>
                            Կատարված լաբորատոր և գործիքային հետազոտություններ
                        </strong>
                        <x-forms.add-reduce-button type="add" data-row=".lab_row"/>
                        <x-forms.add-reduce-button type="reduce" data-row=".lab_row"/>
                        <x-forms.hidden-counter class="stationary-prescription-rows" name="lab_length"/>

                    @for($s = 0; $s < $repeatables; $s++)
                            <div class="lab_row {{ $s < old('lab_length', 1) ? ' ' : 'd-none' }}">
                                <div class="my-2">
                                    <x-forms.magic-search class="magic-search ajax my-2" data-catalog-name="lab_service"
                                                          hidden-id="labService_id{{$s}}" hidden-name="labService_id[]" autocomplete="off"
                                                          placeholder="Ընտրել սոցիալական խումբը․․․" />
                                    <em class="error text-danger" data-input="department_id"></em>
                                </div>


                                <div class="my-2">
                                    <x-forms.text-field type="textarea" placeholder="լրացման աազատ դաշտ․․․"
                                                        value='{{ old("lab_comments.$s") }}' name="lab_comments[]"
                                                        validationType="ajax" label="" />
                                </div>

                                <strong>Քանակ՝</strong>
                                <x-forms.text-field type="number" name='lab_count[]' label=""
                                                    value='{{ old("lab_count.$s") }}' validationType="ajax" placeholder="նշել քանակը․․․" />
                                <hr class="hr-dashed">
                            </div>
                        @endfor
                    </li>



                    <li class="list-group-item">
                        <strong>Բժիշկ</strong>
                        <x-forms.magic-search hidden-id="r_attending_doctor_id" hidden-name="responsible_nurse"
                                              placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2"
                                              data-list-name="users"
                                              value=""/>
                        <em class="error text-danger" data-input="responsible_nurse"></em>

                    </li>

                    <input type="hidden" name="stationary_id" value="{{$stationaries->id}}">
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                    <input type="hidden" name="user_id" value="{{auth()->id()}}">

                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])
            </ul>

        </form>
    </div>
@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>
    <script>
            var repeatables = {{$repeatables}};

        const servicesUrl = @json(route('catalogs.services_full'));
        $('[id^="service_search"]').magicsearch(
            window.medexMagicSearch.assignConfigs({
                type: "ajax",
                // dataSource: `${servicesUrl}?filterBy=department_id&needle=0`,
                dataSource: `${servicesUrl}`,
                fields: ["code", "name"],
                id: "id",
                format: "%code% %name%",
                success: function ($input, data) {
                    console.log(data)
                    const hidden_input_id = $input.data('hidden');
                    $(hidden_input_id).val($input.attr("data-id"));
                },
                afterDelete: function ($input, data) {
                    const hidden_input_id = $input.data("hidden");
                    $(hidden_input_id).val("");
                }
            })
        );

        $(".medicines-search").magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: "/catalogs/medicines.json",
                type: "ajax",
                success: function ($input, data) {
                    const hidden_id = $input.data("hidden");
                    $(hidden_id).val($input.attr("data-id"));
                }
            })
        );

    </script>
@endsection
