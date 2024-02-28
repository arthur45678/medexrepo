@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ԷՐԻՏՐՈՑԻՏՆԵՐԻ ՄՈՐՖՈԼՈԳԻԱ</h3>
    <h3>Морфология эритроцитов</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable" action="{{route('samples.patients.erythrocyte-morphology.store' , ['patient'=> $patient])}}" method="POST">
        @csrf
        <ul class="list-group">
                <li class="list-group-item">
                    <div>
                        <div><strong>Անոզիցիտոզ(մակրոցիտոզներ,միկրոցիտներ, մեգալոցիտներ)</strong></div>
                        <x-forms.text-field type="textarea" name="anocytosis_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Анозицитоз ( макроцитозы,  микроциты, мегалоциты)" /> 
                    </div>
                </li>

                <li class="list-group-item">
                    <div>
                        <div><strong>Պոյկիլոցիտոզ</strong></div>
                        <x-forms.text-field type="textarea" name="poikilocytosis_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Пойкилоцитоз" /> 
                    </div>
                </li>

                <li class="list-group-item">
                    <div>
                        <div><strong>Բազոֆիլ հատիկավորմամբ էրիտրոցիտներ</strong></div>
                        <x-forms.text-field type="textarea" name="basophil_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Базофильная зернистость" /> 
                    </div>
                </li>

                <li class="list-group-item">
                    <div>
                        <div><strong>Պոլիխրոմատոֆիլիա</strong></div>
                        <x-forms.text-field type="textarea" name="polychromatophilia_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Полихроматофолия" /> 
                    </div>
                </li>

                <li class="list-group-item">
                    <div>
                        <div><strong>Ժոլիի մարմիններ, Կեբոտի օղակներ</strong></div>
                        <x-forms.text-field type="textarea" name="jolie_bodies_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Тельца Жолли, кольца Кебота" /> 
                    </div>
                </li>

                <li class="list-group-item">
                    <div>
                        <div><strong>Էրիթրո-նորմոբլաստներ (100 լեյկոցիտի համար)</strong></div>
                        <x-forms.text-field type="textarea" name="erythronormoblasts_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Эритро-нормобласты (из 100 лейкоцитов)" /> 
                    </div>
                </li>

                <li class="list-group-item">
                    <div>
                        <div><strong>Մեգալոբլաստներ</strong></div>
                        <x-forms.text-field type="textarea" name="mesaloblasts_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Мегалобласты" /> 
                    </div>
                </li>

                <li class="list-group-item">
                    <div>
                        <div ><strong>Լեյկոցիտների մորֆոլոգիա</strong></div>
                        <div class="mt-4"><strong>Կորիզների գերսեգմենտացում</strong></div>
                        <x-forms.text-field type="textarea" name="nuclear_over_segmentation_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Гиперсегментация ядер" /> 
                    </div>
                </li>

                <li class="list-group-item">
                    <div>
                        <div><strong>Տոքսոգեն հատիկավորում</strong></div>
                        <x-forms.text-field type="textarea" name="toxic_fatification_comment" validation-type="ajax" placeholder="լրացման ազատ դաշտ․․․" 
                        value="" label="Токсогенная зернистость" /> 
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Անալիզի պատասխանի ամսաթիվ</strong>
                            <br>
                            <strong>Дата выдачи анализа</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="analysis_response_date" validation-type="ajax" type="datetime-local"
                            value="" label="" />
                        </div>
                    </div>
                </li>
                
                <li class="list-group-item">
                        <strong>Բուժող բժիշկ՝</strong>
                        <x-forms.magic-search hidden-id="em_attending_doctor_id" hidden-name="attending_doctor_id"
                        placeholder="Ընտրել բուժող բժիշկին․․․" class="magic-search ajax my-2" data-list-name="users"
                        value="" />
                </li>
                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Ուղարկել'])
        </ul>
    </form>
</div>
@endsection
@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>

@endsection