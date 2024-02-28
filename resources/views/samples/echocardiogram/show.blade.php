<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/echocardiogram.css')}}">
    <title>Էխոկարդիոգրաֆիա</title>
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

            <br>
            <div class="text-center"><strong>Էխոկարդիոգրաֆիա</strong></div>
            <br><br>
            <div class="display-flex">
                <div>Ա․Ա․Հ․</div>
                <div class="bottom-line">{{ $post->patient->getAllNamesAttribute() }}</div>
            </div>
            <br>
            <div class="display-flex">
                <div class="">Տարիք</div>
                <div class="bottom-line">{{ $post->patient->getAgeAttribute() }}</div>
            </div>
            <br>
            <div class="display-flex">
                <div>Ամսաթիվ</div>
                <div class="bottom-line">{{ $post->admission_date }}</div>
            </div>

            <br><br>
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Ձախ փորոք</th>
                        <th >Նորմա</th>
                        <th colspan="2">Աջ փորոք</th>
                        <th>Նորմա</th>
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td>ՁՓ դիաստոլիկ չափս (սմ)</td>
                            <td>{{ $post->diastolic_size_KDR }}</td>
                            <td>4-5.5սմ</td>
                            <td>ԱՓ դիաստոլիկ չափս (սմ)</td>
                            <td>{{ $post->AP_diastolic_size }}</td>
                            <td>&#8804;3.5(սմ)</td>
                        </tr>
                        <tr>
                            <td>ՁՓ սիստոլիկ չափս (սմ)</td>
                            <td>{{ $post->diastolic_size_KCR }}</td>
                            <td>3-4.5սմ</td>
                            <td>ԱՓ պատ(սմ)</td>
                            <td>{{ $post->AP_wall_norma }}</td>
                            <td>&#8804;0.5</td>
                        </tr>
                        <tr>
                            <td>ՁՓ դիաստոլիկ ծավալ (մլ)</td>
                            <td>{{ $post->diastolic_size_KDO }}</td>
                            <td >55-160մլ</td>
                            <td>Աորտաի արմատի տրամագիծ(սմ)</td>
                            <td>{{ $post->aortic_roo_diameter }}</td>
                            <td>&#8805;2.0-3.7(սմ)</td>
                        </tr>
                        <tr>
                            <td>ՁՓ սիստոլիկ  ծավալ (մլ)</td>
                            <td>{{ $post->diastolic_size_KCO }}</td>
                            <td>19-85մլ</td>
                            <td>Ձախ նախասրտի տրամագիծ(սմ)</td>
                            <td>{{ $post->left_atrium_diameter }}</td>
                            <td>3.0-4.0(սմ)</td>
                        <tr>
                            <td>Հետին պատ(սմ)</td>
                            <td>{{ $post->back_wall }}</td>
                            <td>0.7-1.1սմ</td>
                            <td>Ձախ նախասրտի փոքր չափս(սմ)</td>
                            <td>{{ $post->small_size_of_the_left_atrium }}</td>
                            <td>&#8804;4.4(սմ)</td>
                        </tr>
                        <tr>
                            <td>Միջփորոքային միջնապատ(սմ)</td>
                            <td>{{ $post->small_size_of_the_left_atrium }}</td>
                            <td>0,7-1.1սմ</td>
                            <td>Ստորին սիներակի չափս(սմ)</td>
                            <td>{{ $post->the_size_of_the_lower_window }}</td>
                            <td>&#8804;2.1(սմ)</td>
                        </tr>
                        <tr>
                            <td>Արտամղման ֆրակցիա(%)(EF)</td>
                            <td>{{ $post->extraction_fraction }}</td>
                            <td>&#8805;55%</td>
                            <td>Ստորին սիներակի կոլապս(%)</td>
                            <td>{{ $post->collapse_of_the_lower_eyelid }}</td>
                            <td>&#8805;50%</td>
                        </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <div class="text-center"><strong>Եզրակացություն</strong></div>
                    <p>{{ $post->decision }}</p>
                    <br><br>
                    <div class="display-flex">
                        <div>Բժիշկ Ա․Ա․</div>
                        <div class="bottom-line">{{ $post->attending_doctor->f_name }} {{ $post->attending_doctor->l_name }}</div>
                    </div>
        </div>
     </div>
</div>
</body>
</html>
