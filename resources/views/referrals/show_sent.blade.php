@extends('layouts.cardBase')

@section('css')
<style>
    input.form-control:disabled,
    textarea.form-control:disabled {
        background-color: #ffffff;
        font-size: 16px;
    }
</style>
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <div class="list-group-item list-group-item-info">
        <h5>Ուղարկված Ուղեգիր № {{$referral->id}} </h5>
    </div>
</div>
@endsection



@section('card-content')
{{-- @include('shared.info-box') --}}

<div class="container" id="sent-referral-show">
    <form class="ajax-submitable-off">
        @csrf
        <ul class="list-group">

            <li class="list-group-item list-group-item-dark py-0">
                <h6 class="my-0 py-1">Ուղեգրված հիվանդի տվյալները․</h6>
            </li>
            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light mr-1">1.</span>
                    Ազգանուն, անուն, հայրանուն
                </strong>
                <ins class="ml-4">{{$referral->patient->all_names}}</ins>
            </li>
            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light mr-1">2.</span>
                    Ծննդյան թիվը՝
                </strong>
                <ins class="ml-4">{{$referral->patient->birth_date_reversed}}</ins>
            </li>
            <hr class="hr-dotted">

            <div class="container">
                <li class="list-group-item list-group-item-dark py-0">
                    <h6 class="my-0 py-1">Ստացողի տվյալները․</h6>
                </li>
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">3.</span>
                        Ստացող բաժին/օգտատեր
                    </strong>
                    <x-forms.text-field name="department_id" class="my-2" disabled="true" value="{{$referral->department->name}}"/>
                    <x-forms.text-field name="receiver_id" class="my-2" disabled="true" value="{{$referral->receiver->full_name ?? 'բաժին'}}" />
                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">4.</span>
                        Ծառայություն/վճարման տեսակ/լրացուցիչ տեղեկություն
                    </strong>

                    {{-- @forelse ($referral->services as $s_key => $service)
                        @php($payment_type = __("enums.service_payment_type_enum.{$service->pivot->payment_type}"))
                        <div class="container">
                            <strong>№ {{$s_key + 1 }} - ծառայություն</strong>
                            <x-forms.text-field name="service_id" class="my-2" disabled="true" value="{{$service->code}} - {{$service->name}}" />
                            <x-forms.text-field name="payment_type" class="my-2" disabled="true" value='{{$payment_type}}'/>
                            <x-forms.text-field type="textarea" class="my-2" name="comment" disabled="true" value="{{$service->pivot->comment}}" />
                        </div>
                    @empty
                    @endforelse --}}

                    @forelse ($referral->referral_services as $s_key => $service)
                        @php($payment_type = __("enums.service_payment_type_enum.{$service->payment_type}"))
                        <div class="container">
                            <strong>№ {{$s_key + 1 }} - ծառայություն</strong>
                            <x-forms.text-field name="service_id" class="my-2" disabled="true" value="{{$service->serviceable->code}} - {{$service->serviceable->name}}" />
                            <x-forms.text-field name="payment_type" class="my-2" disabled="true" value='{{$payment_type}}'/>
                            <x-forms.text-field type="textarea" class="my-2" name="comment" disabled="true" value="{{$service->comment}}" />
                        </div>
                    @empty
                    @endforelse
                </li>
            </div>
        </ul>
    </form>
</div>
@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
@endsection
