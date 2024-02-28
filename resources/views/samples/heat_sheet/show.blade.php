<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/heat_sheet.css')}}">
    <title>Ջերմության թերթիկ</title>
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
            <div class="text-center"><strong>Ջերմության թերթիկ</strong></div>
            <br><br>

            <div class="display-flex">
                <div>Ա․Ա․Հ․</div>
                <div class="bottom-line">{{ $post->patient->getAllNamesAttribute() }}</div>
            </div>
            <div class="display-flex">
                <div>Քարտ No:</div>
                <div class="bottom-line">{{ $post->id }}</div>
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
            <div class="display-flex">
                <div>Հիվանդության օրը</div>
                <div class="bottom-line">{{ $post->day_of_illness_date }}</div>
            </div>


            <div class="display-flex">
                <div>Բուժող բժիշկ՝</div>
                <div class="bottom-line">{{ $post->attending_doctor_id }}</div>
            </div>
            <div class="display-flex">
                <div>Բաժանմունք՝</div>
                <div class="bottom-line">{{   $post->department->name ?? '' }}</div>
            </div>

            <div class="display-flex">
                <div>Պ</div>
                <div class="bottom-line">{{ $post->p }}</div>
            </div>
            <div class="display-flex">
                <div>T</div>
                <div class="bottom-line">{{ $post->t_0 }}</div>
            </div>
            <br><br>
            <div class="display-flex">
                <div>ԱՃ</div>
                <div><p>{{ $post->text_comment }}</p></div>
            </div>

            @foreach($charts->split(3) as $item)
                <canvas id="canvas_{{ $item[0]->id }}"></canvas>
            @endforeach

        </div>
    </div>
</div>
<script src="https://www.chartjs.org/dist/master/chart.min.js"></script>
<script src="https://www.chartjs.org/samples/master/utils.js"></script>

<script>


    @foreach($charts->split(3) as $item)
        new Chart(document.getElementById("canvas_{{ $item[0]->id }}"), {
        "type": "line",
        "data": {
            "labels": [
                @php
                $str = '';
                @endphp
                @foreach($charts as $item)
                @php
                     $str = utf8_decode("'").$item->day.'.'. $item->day_time_period .utf8_decode("',");
                     echo $str;
                    @endphp
                @endforeach
            ],
            "datasets": [{
                "label": "Ջերմության թերթիկ",
                "data": [36,42, 37,41], // gagatnaket
                "fill": false,
                "borderColor": "rgb(75, 192, 192)",
                "lineTension": 0.1
            }]
        },
        "options": {}
    });
    @endforeach
</script>
</body>

</html>
