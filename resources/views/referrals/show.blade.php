@extends('layouts.cardBase')

{{-- @section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection --}}


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>Ուղեգիր</h3>
</div>
@endsection


@section('card-content')

<div class="container">
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

        <li class="list-group-item list-group-item-dark py-0">
            <h6 class="my-0 py-1">Ուղարկողի տվյալները․</h6>
        </li>
        <li class="list-group-item">
            <strong>
                <span class="badge badge-light mr-1">3.</span>
                Ուղարկող բաժին/օգտատեր
            </strong>
            <x-forms.text-field name="department_id" class="my-2" disabled="true" value="{{$referral->sender->department->name}}"/>
            <x-forms.text-field name="receiver_id" class="my-2" disabled="true" value="{{$referral->sender->full_name ?? 'բաժին'}}" />
            <form action="{{route('reference.UpdateDate')}}" method="post">
                @csrf

                <label for="">Ընդունման ժամը</label>
            <input type="datetime-local" class="form-control" name="start" value="@isset($calendar->start){{ \Illuminate\Support\Carbon::parse($calendar->start)->format('Y-m-d\TH:i') ?? ''}}@endisset">
                <label for="">Ավարտի ժամը</label>
                <input type="time" class="form-control" name="end" value="@isset($calendar->end){{\Illuminate\Support\Carbon::parse($calendar->end)->format('H:i') ?? ''}}@endisset">
                <input type="hidden" name="calendar_id" value="{{$calendar->id ?? ' '}}">
                <input type="hidden" name="referral_id" value="{{$referral->id ?? ' '}}">
                <textarea name="description" class="form-control" placeholder="Մեկնաբանություն">{{$calendar->comments ?? ' '}}</textarea>
                <br>
                <input type="submit" class="btn btn-success btn-confirmable" value="Պահպանել">
            </form>
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
    </ul>
    @if ((auth()->id() === $referral->receiver_id))
    <div class="d-flex justify-content-center mt-4">
        @if (is_null($referral->accepted_at) && is_null($referral->finished_at))
            <div class="mx-2">
                <form action="{{ route('referrals.accept', ['referral_id' => $referral->id]) }}" method="POST">
                    @csrf
                    <button class="btn btn-success btn-confirmable" data-confirm="Համոզվա՞ծ եք, որ ցանկանում եք ընդունել: Ընդունման դեպքում Դուք դիտարկվելու եք որպես ուղեգրի կատարման պատասխանատու">Ընդունել</button>
                </form>
            </div>
            <div class="mx-2">
                <form action="{{ route('referrals.destroy', ['referral_id' => $referral->id]) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-confirmable" data-confirm="Համոզվա՞ծ եք, որ ցանկանում եք չեղարկել: Չեղարկման դեպքում ուղարկված ուղեգիրը և հիվանդի անձնական էջը այլևս հասանելի չեն լինելու">Չեղարկել</button>
                </form>
            </div>
        @elseif(is_null($referral->finished_at))
           <div class="mx-2">
                <form action="{{ route('referrals.finish', ['referral_id' => $referral->id]) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-confirmable" data-confirm="{{ auth()->user()->department->closed_from_outside ? __('referrals.finish_confirm_closed') : __(
                        'referrals.finish_confirm_opened'
                    ) }}">Ավարտել</button>
                </form>
            </div>
        @endif
    </div>
    @endif
</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
@endsection
