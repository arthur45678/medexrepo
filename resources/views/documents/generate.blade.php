@extends('layouts.cardBase')

@section('card-header')
Փաստաթուղթի գեներացում
<div class="card-header-actions">
    <button class="btn btn-primary" data-toggle="modal" data-target="#card-modal">
        <x-svg icon="cui-plus" />
        Document
    </button>
</div>
@endsection

@section('card-content')

<x-modal modal-id="card-modal" title="Ամբուլատոր քարտ - սկզբանական տվյալներ" form-id="card-form">
    <form action="{{route("documents.store")}}" id="card-form" method="POST">
        @csrf
        <div class="form-group">
            <label>Քարտի համար</label>
            <input name="card_number" class="form-control" type="number" max="999999" min="1" />
        </div>
        <div class="form-group">
            <label>Խումբ</label>
            <select name="cancer_type" class="form-control">
                <option value="Iա">Iա</option>
                <option value="Iբ">Iբ</option>
                <option value="II">II</option>
                <option value="II">IIա</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
            </select>
        </div>
        <div class="form-group">
            <label>Վնասակար սովորթություններր</label>
            <textarea name="text" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" id="gender-male" type="radio" value="male" name="patient_gender">
                <label class="form-check-label" for="gender-male">Տղամարդ</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" id="gender-female" type="radio" value="female" name="patient_gender">
                <label class="form-check-label" for="gender-female">Կին</label>
            </div>
        </div>
        <div class="form-group">
            <label>Գեներացման տարբերակ</label>
            <div class="form-check">
                <input class="form-check-input" id="generate-pdf" type="radio" value="pdf" name="file_type">
                <label class="form-check-label" for="generate-pdf">PDF</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" id="generate-word" type="radio" value="word" name="file_type">
                <label class="form-check-label" for="generate-word">Word</label>
            </div>
        </div>
    </form>
</x-modal>

@endsection

@section('javascript')

@endsection
