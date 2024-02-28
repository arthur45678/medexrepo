@extends('layouts.cardBase')

@section('css')
<link rel="stylesheet" href="{{mix('/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{mix("/css/jquery.magicsearch.min.css")}}"/>
@endsection

@section('card-header')
Հիվանդներ | {{ $patient->all_names }} ({{ $patient->soc_card }})
<div class="card-header-actions d-flex">

    <a href='{{ route("patients.barcode", ['patient'=>$patient]) }}' target="_blank" class="btn btn-primary mr-2" target="_blank">
        <x-svg icon="cui-barcode" />
        Շտրիխ կոդ
    </a>

    <a href='{{ route("patients.referrals.create", ["patient" => $patient]) }}' target="_blank" class="btn btn-primary mr-2" target="_blank">
        <x-svg icon="cui-plus" />
        Ուղեգիր
    </a>

    @can('update patients')
    <a href="{{ route('patients.edit', ['patient' => $patient]) }}" class="btn btn-primary mr-2">
        <x-svg icon="cui-pencil" />
    </a>
    @endcan
    @cannot('update patients')
        <button class="btn btn-secondary mr-2" disabled><x-svg icon="cui-pencil" /></button>
    @endcannot
    <button href="#"  class="btn btn-primary" data-target="#file-attachment-modal" data-toggle="modal">
        <x-svg icon="cui-paperclip" />
    </button>
</div>

<!-- modal: attach new file to patient's document -->
{{-- Չնայած, որ վերբեռնումը լինելու է հատ-առ-հատ, ՄԻԱՅՆ attachment_comments-դաշտը պահում ենք  որպես զանգված,
    որպեսզի օգտվելով ֆայլերի վերբեռնման մի կառուցվածից չստացվի այնպես, որ պահպանում ենք քոմենթի առաջին տառը։
    Ընդ որում, կոնկրետ հիվանդին կցված փաստաթղթերը ցուցյց տալիս, քոմենթը հանդես կգա իբրև "Անվանում":
--}}
<x-modal modal-id="file-attachment-modal" title="Կցել փաստաթուղթ">
    <form action='{{route("patients.store_file")}}' method="POST" id="file-attachment-form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="patient_id" value="{{$patient->id}}">
        <ul class="list-group">
            <li class="list-group-item">
                <x-forms.text-field label='Ընտրել փաստաթուղթը' name='attachments' type='file' validationType='ajax' />
            </li>
            <li class="list-group-item">
                <x-forms.text-field label='Փաստաթղթի անվանումը' name='attachment_comments[]' type='text' validationType='ajax' />
            </li>
            @include('shared.forms.list_group_item_submit', ["has_files" => true])
        </ul>
    </form>
</x-modal>

@endsection

@section('card-content')
<div class="nav-tabs-boxed">
    <ul class="nav nav-tabs" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab" aria-controls="home"
                aria-selected="true">
                Անձնական տվյալներ
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile"
                aria-selected="false">
                Պատմություն
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#sample-1" role="tab" aria-controls="sample"
                aria-selected="false">
                Ձևամնուշներ/Քարտեր
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#attachment-1" role="tab" aria-controls="attachment"
                aria-selected="false">
                Կից ֆայլեր
            </a>
        </li>

    </ul>
    <div class="tab-content">

        <div class="tab-pane active" id="home-1" role="tabpanel">
            <div class="row">
                <div class="col-md-2">
                    <div>
                        <img src="{{asset("/assets/img/avatars/patient.png")}}" alt="Patient" class="img img-fluid" />
                    </div>
                    <div class="text-center mt-2">
                        {{-- {!! '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("$patient->soc_card", 'C39',1.2,33, array(1,1,1), true) . '" alt="'.$patient->soc_card.'"   class="img img-fluid"/>' !!} --}}
                        {!! DNS1D::getBarcodeSVG("$patient->soc_card", 'C128', 1.4, 44) !!}
                    </div>
                    <div>
                        {{-- <img src="{{asset("/assets/img/barcode.svg")}}" alt="Patient" class="img img-fluid"> --}}
                    </div>
                </div>
                <div class="col-md-10">
                    <form action="?">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Անուն</label>
                                <input value="{{ $patient->f_name }}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Ազգանուն</label>
                                <input value="{{ $patient->l_name }}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Հայրանուն</label>
                                <input value="{{ $patient->p_name }}" type="text" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Ծն․ ամսաթիվ</label>
                                <input value="{{ $patient->birth_date }}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Հծհ</label>
                                <input value="{{ $patient->soc_card }}" type="number" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Էլ․ հասցե</label>
                                <input value="{{ $patient->email }}" type="email" class="form-control" disabled />
                            </div>
                        </div>

                        <h5>Գրանցման Հասցե</h5>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Մարզ</label>
                                <input value="{{ $patient->residence_region }}" type="text" class="form-control"
                                    disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Քաղաք/Գյուղ</label>
                                <input value="{{ $patient->town_village }}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-5">
                                <label>Փողոց/Շենք</label>
                                <input value="{{ $patient->street_house }}" type="text" class="form-control" disabled />
                            </div>
                            {{-- <div class="form-group col-md-1">
                                <label>Շենք</label>
                                <input value="9/1" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-2">
                                <label>Բնակարան</label>
                                <input value="24" type="number" class="form-control" disabled />
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Հեռ․ Բջջային</label>
                                <input value="{{ $patient->m_phone }}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Հեռ․ Քաղաքային</label>
                                <input value="{{ $patient->c_phone }}" type="text" class="form-control" disabled />
                            </div>

                            <div class="form-group col-md-3">
                                <label>Սեռ</label>
                                <input value="{{ $patient->sex }}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Արյան Կարգ</label>
                                <input value="{{ $patient->blood_type }}" type="text" class="form-control" disabled />
                            </div>
                            @if($patient->archive == 0)
                                <div class="form-group col-md-3">
                                    <label>Արխիվ</label>
                                    <input value="Ոչ " type="text" class="form-control" disabled />
                                </div>
                            @elseif($patient->archive == 1)
                                <div class="form-group col-md-3">
                                    <label>Արխիվ</label>
                                    <input value="Այո " type="text" class="form-control" disabled />
                                </div>
                            @endif
                        </div>

                        <hr><hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Ազգություն</label>
                                <input value="{{ $patient->nationality }}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Քաղաքացիություն</label>
                                <input value="{{ $patient->citizenship }}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Բնակության վայր</label>
                                <input value="{{ $patient->living_place->name ?? ''}}" type="text" class="form-control" disabled />
                            </div>
                        </div>

                        <h5>Բնակության Հասցե</h5>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Մարզ</label>
                                <input value="{{ $patient->residence_region_residence }}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Քաղաք/Գյուղ</label>
                                <input value="{{ $patient->town_village_residence }}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Փողոց/տուն</label>
                                <input value="{{ $patient->street_house_residence }}" type="text" class="form-control" disabled />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Սոցիալ կենցաղային պայմաններ</label>
                                <input value="{{ $patient->social_living_condition->name ?? ''}}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Աշխատանքային առանձնահատկություններ</label>
                                <input value="{{ $patient->working_feature->name ?? ''}}" type="text" class="form-control" disabled />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Կրթություն</label>
                                <input value="{{ $patient->education->name ?? ''}}" type="text" class="form-control" disabled />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Ամուսնական կարգավիճակ</label>
                                <input value="{{ $patient->marital_status->name ?? ''}}" type="text" class="form-control" disabled />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="profile-1" role="tabpanel">
            <table class="table table-striped datatable-default">
                <thead>
                    <tr>
                        <th>Համար</th>
                        <th>Ծառայություն</th>
                        <th>Քանակ</th>
                        <th>Գործողություն</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($patient_samples as $key => $item)
                    @php
                        $index_route_name = $item['route_name'].".index";
                    @endphp
                    <tr>
                        <td>
                            <strong>{{$key + 1}}</strong>
                        </td>
                        <td>{{$item['name']}}</td>
                        <td>
                            <span class="badge badge-pill badge-info"> {{$item['count']}}</span>
                        </td>
                        <td>
                            <a href='{{route($index_route_name, [$patient])}}' target="_blank" class="btn btn-primary">
                                <x-svg icon="cui-external-link" />
                                դիտել
                            </a>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="tab-pane" id="sample-1" role="tabpanel">
            <div class="card text-center">
                <div class="card-header bg-primary">
                    <h5 class="text-white">Ստեղծել ձևանմուշներ/քարտեր</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12 text-left mb-3">
                            <strong>Ձևանմուշների ցանկ</strong>
                            <x-forms.magic-search class="samples-search search-defined mt-1" data-target="patient"
                            value='' hidden-id="sample_id" hidden-name="sample_name"  placeholder="ընտրել ձևանմուշը․․․"/>
                        </div>

                        <div class="col-md-12 d-flex justify-content-between">
                            <div class="col-md-5">
                                @can('create ambulators')
                                    @if ($has_ambulator)
                                        <button class="btn btn-secondary" disabled>Ամբուլատոր քարտը բացված է</button>
                                    @else
                                        <a href='{{ route("patients.ambulator.create", ["patient" => $patient]) }}' target="_blank" class="btn btn-primary btn-block" target="_blank">
                                            <x-svg icon="cui-plus" />
                                            Բացել նոր Ամբուլատոր քարտ
                                        </a>
                                    @endif
                                @endcan
                                @cannot('create ambulators')
                                <button class="btn btn-secondary" disabled>Դուք չեք կարող ստեղծել Ամբուլատոր քարտ</button>
                                @endcannot
                            </div>
                            <div class="col-md-5">
                                @can('create stationaries')
                                <a href='{{ route("patients.stationary.create", ["patient" => $patient]) }}' target="_blank" class="btn btn-primary btn-block" target="_blank">
                                    <x-svg icon="cui-plus" />
                                    Բացել նոր Ստացիոնար քարտ
                                </a>
                                @endcan
                                @cannot('create stationaries')
                                <button class="btn btn-secondary" disabled>Դուք չեք կարող ստեղծել Ստացիոնար քարտ</button>
                                @endcannot
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="attachment-1" role="tabpanel">
            <table class="table table-striped datatable-default">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Փաստաթղթի անուն</th>
                        <th>Ֆայլի անուն</th>
                        <th class="text-center">Գործողություն</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($patient->attachments as $a_key => $attachment)
                    @php
                        // $index_route_name = $attachment->directory.'/'.$attachment->attachment_name;
                        // $link = $attachment->full_path;
                        $show_ext = ['pdf','txt', 'jpg', 'jpeg', 'png'];
                        $btn_text = in_array($attachment->extension, $show_ext)  ? 'դիտել' : 'բեռնել';
                    @endphp
                    <tr>
                        <td><strong>{{$a_key + 1}}</strong></td>
                        <td>{{$attachment->attachment_comment ?? '---'}}</td>
                        <td>{{$attachment->attachment_name}}</td>
                        <td class="d-flex justify-content-around">
                            <a href='{{$attachment->full_path}}' target="_blank" class="btn btn-primary">
                                <x-svg icon="cui-external-link" />
                                {{$btn_text}}
                            </a>
                            @if ($attachment->user_id == auth()->id())
                            <form action="{{route('attachments.delete',['attachable'=>$attachment])}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger mr-1 btn-confirmable" data-confirm="Դուք պատրաստվում եք հեռացնել ընտրված փաստաթուղթը:">
                                    <x-svg icon="cui-delete" />
                                    ջնջել
                                </button>
                            </form>
                            @endif

                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@section('javascript')
<script src="{{mix('/js/jquery.js')}}"></script>
<script src="{{mix('/js/datatables.js')}}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
@endsection
