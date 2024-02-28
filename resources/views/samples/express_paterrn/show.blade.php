<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/express_paterrn.css')}}">
    <title>ԷՔՍՊՐԵՍ ԼԱԲՈՐԱՏՈՐԻԱՆԵՐՈՒՄ ԿԻՐԱՌՎՈՂ ԲԺՇԿԱԿԱՆ ՁԵՎ</title>
    @isset ($for_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endif
</head>
<body>

@if($expres->count()>0)
@include('samples.express_paterrn.include.ManyExpressShow')

@else
@include('samples.express_paterrn.include.oneExpressShow')
@endif
</body>
</html>
