<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/work_time_bulletin.css')}}">
    <title>Աշխատաժամանակի հաշվարկի տեղեկագրեր</title>
</head>
<body>
    <div class="page-wrap">
        <div class="main-container">
            <div class="new-page">
                <br><br><br> <br><br><br>
                <br><br><br> <br><br><br>
                <div class="table-deg">
                    <div class="text-center">Վ.Ա. Ֆանարջյանի անվան Ուռուցքաբանության  Ազգային Կենտրոն ՓԲԸ</div>
                    <br>
                    <p></p>
                    <div class="text-center">(կառուցվածքային ստորաբաժանման անվանումը)</div>
                    <br>
                    <div class="display-flex">
                        <div>
                            <table class="table">
                                <tr>
                                    <td>Փաստաթղթերի համարը</td>
                                    <td>Ամսաթիվը</td>
                                </tr>
                                <tr>
                                    <td>№ {{$department_bulletin->id}}</td>
                                    <td>{{$department_bulletin->created_at->format('d.m.Y')}}</td>
                                </tr>
                            </table>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div>
                            <table  class="table">
                                <tr>
                                    <td colspan="2">Հաշվետու ժամանակաշրջանը</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>{{$department_bulletin->created_at->daysInMonth}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br><br>
                    <table class="table">
                        <tr>
                            <td rowspan="2">Պաշտոնը(մանսագիտությունը)</td>
                            <td rowspan="2">Անուն,Ազգանուն</td>
                            <td rowspan="2">Սոցիալական ապահովության քարտի համարը</td>
                            <td colspan="31">Գրառումներ փաստացի աշխատած ժամանակահատվածի վերաբերյալ</td>
                            <td colspan="2">Ընդամենը ամսվա ընթացքում աշխատած</td>
                            <td colspan="2">Ընթացիկ ամսվա ընթացքում պարապուրդի</td>

                        </tr>
                        <tr>
                            <td>01</td>
                            <td>02</td>
                            <td>03</td>
                            <td>04</td>
                            <td>05</td>
                            <td>06</td>
                            <td>07</td>
                            <td>08</td>
                            <td>09</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
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
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td>օր</td>
                            <td>ժամ</td>
                            <td>օր</td>
                            <td>ժամ</td>
                        </tr>

                        <!-- next content skeleton
                            <tr>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td colspan="31">4</td>
                                <td colspan="2">5</td>
                                <td colspan="2">6</td>
                            </tr>
                        -->

                        @forelse ($department_bulletin->user_work_time_bulletins as $user_bulletin)
                            @php
                                $user_work_time = json_decode($user_bulletin->worktime);

                                $user_month_days = $user_work_time->month_days;
                                $user_summary = $user_work_time->summary;

                                $user_month_idle_days = $user_work_time->month_idle_days;
                                $user_idle_summary = $user_work_time->idle_summary;

                                $hoursToDayHour = minutesHoursToDayHour((array)$user_summary);
                                $idleHoursToDayHour = minutesHoursToDayHour((array)$user_idle_summary);
                            @endphp
                            <tr class="f-12">
                                <td align='center'>{{$user_bulletin->user->position ?? '--'}}</td>
                                <td align='center'>{{$user_bulletin->user->full_name ?? '--'}}</td>
                                <td align="center">{{$user_bulletin->user->soc_card ?? '--'}}</td>

                                @forelse ($user_month_days as $d_key => $user_day)
                                    <td align="center">
                                        <div>{{$user_day}}</div><br>
                                        <div>{{$user_month_idle_days->$d_key}}</div>
                                    </td>
                                @empty
                                @endforelse

                                <td class="summary" colspan="2">
                                    {{$hoursToDayHour['d']}} | {{$hoursToDayHour['h']}} : {{$hoursToDayHour['m']}}
                                </td>

                                <td class="idle-summary" colspan="2">
                                    {{$idleHoursToDayHour['d']}} | {{$idleHoursToDayHour['h']}} : {{$idleHoursToDayHour['m']}}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>

            </div><!-- new-page -->
        </div><!-- main-container -->
    </div><!-- page-wrap -->
</body>
</html>
