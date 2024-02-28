<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/sterilization_mode_sister.css')}}">
    <title>ՄԱՆՐԷԱԶԵՐԾՄԱՆ ՌԵԺԻՄ ՔՈՒՅՐ</title>
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
                <br><br><br><br><br><br><br><br>
                    <div class="table-deg">
                            <table>
                                <tr>
                                    <td rowspan="2">Ամսաթիվ</td>
                                    <td colspan="2">Բժշկական իրեր</td>
                                    <td colspan="2">Մաքրման եղանակ</td>
                                    <td rowspan="2">Մաքրող նյութի անվանում</td>
                                    <td rowspan="2">Ախտահանման եղանակ</td>
                                    <td colspan="2">Ախտահանող նյութի անվանում</td>
                                    <td colspan="2">Ախտահանման ռեժիմ</td>
                                    <td colspan="2">նախամանրէազերծման մշակման ենթարկված բժշկական իրեր</td>
                                    <td rowspan="2">Մշակման ստուգման իրերի քանակ</td>
                                    <td colspan="2">նախամանրէազերծման որակի հսկողության արդյունքներ</td>
                                </tr>
                                <tr>
                                    <td>Անվանում</td>
                                    <td>Քանակ</td>
                                    <td>Մեքենայացված</td>
                                    <td>Ձեռքով</td>
                                    <td>Անվանում</td>
                                    <td>Ըստ կից հրահանգի/%/</td>
                                    <td>Սկիզբ</td>
                                    <td>Վերջ</td>
                                    <td>Անվանում</td>
                                    <td>Քանակ</td>
                                    <td>Արյան հետքերի առկայություն</td>
                                    <td>Լվացող հեղուկի հետքերի առկայություն</td>
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td>16</td>
                                    <td>17</td>
                                    <td>18</td>
                                    <td>19</td>
                                    <td>20</td>
                                    <td>21</td>
                                    <td>22</td>
                                    <td>23</td>
                                    <td>24</td>
                                    <td>25</td>
                                    <td>26</td>
                                    <td>27</td>
                                    <td>28</td>
                                    <td>27</td>
                                    <td>28</td>
                                </tr>
                                <tr>
                                    <td>{{$steril->main_date}}</td>
                                    <td>{{$steril->name}}</td>
                                    <td>{{$steril->count}}</td>
                                    <td>{{$steril->cleaning_method}}</td>
                                    <td>{{$steril->cleaning_method_name}}</td>
                                    <td>{{$steril->cleaning_method_name}}</td>
                                    <td>{{$steril->disinfection_method}}</td>
                                    <td>{{$steril->axt_name}}</td>
                                    <td>{{$steril->according}}</td>
                                    <td>{{$steril->start}}</td>
                                    <td>{{$steril->end}}</td>
                                    <td>{{$steril->nax_name}}</td>
                                    <td>{{$steril->nax_count}}</td>
                                    <td>{{$steril->processing_number}}</td>
                                    <td>{{$steril->presence_blood}}</td>
                                    <td>{{$steril->traces_detergent}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                    </table>
                </div>
            </div>
       </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div class="new-page">
                            <br><br><br><br><br><br><br><br><br>
                            <div class="table-deg">
                                    <table>
                                        <tr>
                                            <td colspan="2">Բժշկական իրերի</td>
                                            <td rowspan="2">Մանրէազերծիչ գործիքի միացման ժամ</td>
                                            <td colspan="4">Մանրէազերծիչ ռեժիմ</td>
                                            <td rowspan="2">Մանրէազերծիչ սարքերի աշխատանքի հսկողություն/քիմիական զգայորոշիչ/</td>
                                            <td colspan="2">Բժշկական իրերի</td>
                                            <td rowspan="2">Մանրէազերծող նյութի անվանում/խտություն ըստ հրահանգի պահանջի (%)</td>
                                            <td rowspan="2">Մանրէազերծող նյութի պատրաստման ամսաթիվ</td>
                                            <td rowspan="2">Թեսթի արդյունքը</td>
                                            <td rowspan="2">Մանրէազերծող սարքի միացման ժամանակ քիմիական նյութի մեջ ընկղման ժամ</td>
                                            <td colspan="2">Մանրէազերծման ռեժիմ</td>
                                            <td rowspan="2">Կատարող անձի ստորագրություն</td>
                                        </tr>
                                        <tr>
                                            <td>Անվանում</td>
                                            <td>Քանակ</td>
                                            <td>Սկիզբ ժամ</td>
                                            <td>Ջերմաստիճան 180</td>
                                            <td>Վերջ ժամ</td>
                                            <td>Հանելու ժամ</td>
                                            <td>Անվանում</td>
                                            <td>Քանակ</td>
                                            <td>Սկիզբ ժամ</td>
                                            <td>Վերջ ժամ</td>
                                        </tr>
                                        <tr>
                                            <td>{{$steril->medical_name}}</td>
                                            <td>{{$steril->medical_count}}</td>
                                            <td>{{$steril->sterilizer_tool_time}}</td>
                                            <td>{{$steril->steril_tool_time}}</td>
                                            <td>{{$steril->steril_tool_temperature}}</td>
                                            <td>{{$steril->steril_tool_endtime}}</td>
                                            <td>{{$steril->steril_tool_removetime}}</td>
                                            <td>{{$steril->control_sterilizers}}</td>
                                            <td>{{$steril->medical_tools_name}}</td>
                                            <td>{{$steril->medical_tools_count}}</td>
                                            <td>{{$steril->medical_itemsname_disinfectant}}</td>
                                            <td>{{$steril->steril_prep_date}}</td>
                                            <td>{{$steril->test_result}}</td>
                                            <td>{{$steril->steril_material_time}}</td>
                                            <td>{{$steril->steril_mode_start}}</td>
                                            <td>{{$steril->steril_mode_end}}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </table>
                            </div>
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div class="new-page">
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                            <div class="table-deg">
                                    <table>
                                        <tr>
                                            <td rowspan="2">Մանրէազերծող նյութի պատրաստման ամսաթիվ</td>
                                            <td rowspan="2">Թեսթի արդյունքը</td>
                                            <td rowspan="2">Մանրէազերծող սարքի միացման ժամանակ քիմիական նյութի մեջ ընկղման ժամ</td>
                                            <td colspan="2">Մանրէազերծման ռեժիմ</td>
                                            <td rowspan="2">Կատարող անձի ստորագրություն</td>
                                        </tr>
                                        <tr>
                                            <td>Սկիզբ ժամ</td>
                                            <td>Վերջ ժամ</td>
                                        </tr>
                                        <tr>
                                            <td>{{$steril->steril_prep_date}}</td>
                                            <td>{{$steril->test_result}}</td>
                                            <td>{{$steril->steril_material_time}}</td>
                                            <td>{{$steril->steril_mode_start}}</td>
                                            <td>{{$steril->steril_mode_end}}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                    </table>
                            </div>
                </div>
        </div>
</div>

</body>
</html>
