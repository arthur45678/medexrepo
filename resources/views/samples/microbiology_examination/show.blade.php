<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/histological_examination.css')}}">
    <title>ՄԱՆՐԷԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</title>
    <style>
        td{
            padding: 15px 10px;
            width: 50%;
        }
    </style>
    @isset ($for_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endif
</head>
<body>
<div class="page-wrap">
    <div class="new-page">
        <div class="main-container">
            <div style="margin: 0px auto">
                <div class="display-flex">
                    <div>ԲԺՇԿԱԿԱՆ ՁԵՎ N {{ $post->id }}</div>
                    <span class="bottom-line">10</span>
                    <span class="bottom-line" style="margin-left: 50px">{{ $post->susceptibility_to_antibiotics_date }} </span> թ․
                </div>
            </div>
            <br><br><br>
            <div class="text-center">
                <br>
                <div>ՀՀ ԱՌՈՂՋԱՊԱՀՈՒԹՅԱՆ  ՆԱԽԱՐԱՐՈՒԹՅՈՒՆ</div>
                <br><br>
                <div> Վ. Ա. ՖԱՆԱՐՋՅԱՆԻ ԱՆՎԱՆ ՈՒՌՈՒՑՔԱԲԱՆՈՒԹՅԱՆ ԱԶԳԱՅԻՆ ԿԵՆՏՐՈՆՓԲԸ</div>
            </div>
            <br><br>
            <div>ՄԱՆՐԷԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ: - {{ $post->medical_company_name }}</div>
            <br><br>
            <div style="margin: 0px auto">
                <div class="display-flex">
                    <div>Զգայունության որոշում հակաբիոտիկների հանդեպ N: {{ $post->susceptibility_to_antibiotics }}</div>
                    <span class="bottom-line">10 </span>
                    <span class="bottom-line" style="margin-left: 50px">{{ $post->susceptibility_to_antibiotics_date }} </span> թ․
                </div>
            </div>
            <br>
            <br>
            <div class="display-flex">
                <div>Ազգանուն, անուն, հայրանուն</div>
                <span class="bottom-line">{{ $post->patient->getAllNamesAttribute() }}</span>
                <div style="margin-left: 50px">Տարիք</div>
                <span class="bottom-line">{{ $post->patient->getAgeAttribute() }}</span>
            </div>
            <br>
            <div class="display-flex">
                <div>Բաժանմունք</div>
                <span class="bottom-line">{{ $post->department->name }}</span>
                <div style="margin-left: 50px">Պալատ</div>
                <span class="bottom-line">{{ $post->room }}</span>
            </div>
            <br>
            <div>
                <div style="margin-bottom: 5px">Ուղեգրող բժշկի անուն, ազգանուն</div>
                <span class="bottom-line">{{ $post->attending_doctor->getFullNameAttribute()}}</span>
            </div>
            <br>
            <div class="display-flex">
                <div>Ամբուլատոր բժշկական քարտի/հիվանդության պատմագրի N</div>
                <span class="bottom-line">652</span>
            </div>
            <br>
            <div class="display-flex">
                <div>
                    <strong>Մանրէաբանական հետազոտություն</strong>
                </div>
                <span class="bottom-line">{{ $post->microbiology_examination }}</span>
            </div>
            <br>
            <div class="display-flex">
                <div>
                    <strong>Անջատված միկրոֆլորա</strong>
                </div>
                <span class="bottom-line">{{ $post->isolated_microflora }}</span>
            </div>
            <br>
            <div>
                <div><strong>Զգայունության որոշում հակաբիոտիկների հանդեպ</strong></div>
                <br>
                <table class="table table-bordered table-md" style="width: 100%;margin:auto">
                    <tr>
                        <td>
                            Ամոքսիկլավ (աուգմենտին) <span class="bottom-line">{{ isset($post->amoxiclav_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_amoxiclav }}
                            </p>
                        </td>
                        <td>
                            Ցիպրոֆլոքսացին <span class="bottom-line">{{ isset($post->antibiotk_ciprofloxacin) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_ciprofloxacin }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ազիտրոմիցին <span class="bottom-line">{{ isset($post->azithromycin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_azithromycin }}
                            </p>
                        </td>
                        <td>
                            Կարբենիցիլին <span class="bottom-line">{{ isset($post->Carbenicillin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Carbenicillin }}
                            </p>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ամպիցիլին <span class="bottom-line">{{ isset($post->ampicillin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->ampicillin_is_sensitive }}
                            </p>
                        </td>
                        <td>
                            Ցեֆազոլին <span class="bottom-line">{{ isset($post->Cefazolin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Cefazolin }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ամոքսիցիլին <span class="bottom-line">{{ isset($post->Amoxicillin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Amoxicillin }}
                            </p>
                        </td>
                        <td>
                            Ցեֆոտաքսիմ (կլաֆորան) <span class="bottom-line">{{ isset($post->Cefotaxime_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Cefotaxime }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Օքսացիլին <span class="bottom-line">{{ isset($post->Oxacillin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Oxacillin }}
                            </p>
                        </td>
                        <td>
                            Ցեֆտազիդիմ (ֆորտում) <span class="bottom-line">{{ isset($post->Ceftazidime_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Ceftazidime }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Գենտամիցին <span class="bottom-line">{{ isset($post->Gentamicin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Gentamicin }}
                            </p>
                        </td>
                        <td>
                            Ցեֆուրոքսիմ (զինացեֆ) <span class="bottom-line">{{ isset($post->Gentamicin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Gentamicin }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Վանկոմիցին <span class="bottom-line">{{ isset($post->Vancomycin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Vancomycin }}
                            </p>
                        </td>
                        <td>
                            Ցեֆտրիաքսոն (ռոտացեֆ) <span class="bottom-line">{{ isset($post->Ceftriaxone_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Ceftriaxone }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Իմիպենեմ (մերոպենեմ) <span class="bottom-line">{{ isset($post->Imipenem_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Imipenem }}
                            </p>
                        </td>
                        <td>
                            Մոքսիֆլոքսացին (ավելոքս) <span class="bottom-line">{{ isset($post->antibiotk_Moxifloxacin) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->Moxifloxacin_is_sensitive }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Պենիցիլին <span class="bottom-line">{{ isset($post->Penicillin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Penicillin }}
                            </p>
                        </td>
                        <td>
                            Նորֆլոքսացին <span class="bottom-line">{{ isset($post->Norfloxacin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Norfloxacin }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Մետրոնիդազոլ <span class="bottom-line">{{ isset($post->Metronidazole_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Metronidazole }}
                            </p>
                        </td>
                        <td>
                            Ցեֆոպերազոն <span class="bottom-line">{{ isset($post->	Cefoperazone_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Cefoperazone }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Դոքսիցիլին <span class="bottom-line">{{ isset($post->Doxicillin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_Doxicillin }}
                            </p>
                        </td>
                        <td>
                            Ֆուրադոնին <span class="bottom-line">{{ isset($post->furodonin_is_sensitive) ? 'զգայուն է' : 'զգայուն չէ'}}</span>
                            <p>
                                {{ $post->antibiotk_furodonin }}
                            </p>
                        </td>
                    </tr>

                </table>
            </div>
            <br>
            <div>
                <div style="margin-bottom: 5px">Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</div>
                <span class="bottom-line">{{ $post->attending_doctor->getFullNameAttribute() }}</span>
            </div>
            <br>
            <div class="display-flex">
                <div>Ստորագրություն____________________</div>
            </div>
            <br>
            <div class="display-flex">
                <div>Հակաբիոտիկների հանդեպ զգայունության որոշման պատասխանի տրման օր, ամիս, տարի</div>
                <span class="bottom-line">{{ $post->antibiotic_sensitive_date }}</span>
            </div>
            <br>
            <br>
        </div>
    </div>
</div>
</div>
</body>
</html>
