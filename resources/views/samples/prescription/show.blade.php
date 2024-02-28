<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ՆՇԱՆԱԿՄԱՆ ԹԵՐԹԻԿ</title>
    <link rel="stylesheet" href="{{mix('css/print/prescription.css')}}">
    @isset ($for_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endif
</head>
<body>

	<div class="page-wrap">
		<div class="main-container">
			<br><br>
			<div class="text-center"><strong>ՆՇԱՆԱԿՄԱՆ ԹԵՐԹԻԿ</strong> </div>
			<br><br>
			<div class="display-flex">
				<div>Բաժանմունքի անվանումը</div>
				<div class="bottom-line">{{$sheet->departments->name}}</div>
			</div>
			<br>
			<div class="display-flex">
				<div>Հիվանդասենյակի համարը</div>
				<div class="bottom-line">N {{$sheet->hospital_room_number}}</div>
			</div>
			<br>
			<div class="display-flex">
				<div>Հիվանդի ազգանուն,անուն,հայրանուն</div>
				<div class="bottom-line"> {{$patient->full_name}} {{$patient->p_name}}</div>
			</div>
			<br><br>
			<table class="tableName">
				<thead>
					<tr>
						<th rowspan="2">#</th>
						<th rowspan="2">Բուժախտորոշիչ նշանակում</th>
						<th colspan="2" class="container-date">
							Ամսաթիվ
						</th>
					<th rowspan="2">Բժշկի ստորագրությունը</th>
					</tr>
						<tr>
							<th>նշանակում</th>
							<th>հանում</th>
						</tr>
				</thead>
				<tbody>
                @foreach($noMedication as $key=>$diagnostic)
				<tr>
					<td>{{$key}}</td>
					<td>{{$diagnostic->diagnostic->name}}</td>
					<td>{{$diagnostic->appointment_date}} </td>
					<td>{{$diagnostic->end_day}} </td>
					<td></td>
				</tr>
                @endforeach

				</tbody>
			</table>
			<br>
			<div>
				<strong>Ծանոթություն,հիվանդի բուժման ավարտից հետո նշանակման թերթիկը սոսնձվում է հիվանդության պատմությանը:</strong>
			</div>
			<br><br>



            <table class="tableMedication">
                <thead>
                <tr >
                    <th  rowspan="2">#</th>
                    <th  rowspan="2">Դեղամիջոցը</th>
                    <th  colspan="2">նշանակում</th>
                    <th  rowspan="2">Մեկնաբանություն</th>
                    <th  rowspan="2">Ստացվել է դեղատնից</th>
                </tr>
                <tr>
                    <td>Քանակ</td>
                    <td>Չափման միավոր</td>
                </tr>
                </thead>
                <tbody>
                @foreach($prescraption as $k=>$prescraptions)

                        <tr>
                            <td>{{$k+1}}</td>
                            <td>{{$prescraptions->medicine_name->name}}</td>
                            <td>{{$prescraptions->medicine_dose}}</td>
                            <td>{{__('measurement_units.'.$prescraptions->MeasurementUnit->name)}}</td>
                            <td>{{$prescraptions->prescription_comments}} </td>
                            <td>{{$prescraptions->drugs}}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
