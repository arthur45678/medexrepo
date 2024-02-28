
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/medical_waste_register.css')}}">
    <title>Բժշկական թափոնների հաշվառման գրանցամատյան</title>
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


             <br><br><br>
                 <table>
                     <tr>
                        <th>Հ/Հ</th>
                        <th>Բաժանմունքի անվանում</th>
                        <th>Բժշկականթափոնի տեսակ </th>
                        <th>Բժշկականթափոնի տարողության բացման ամսաթիվ</th>
                        <th>Բժշկականթափոնի տեղաթոխման ամսաթիվ</th>
                        <th>Բժշկական թափոնի պատասխանատու</th>
                    </tr>
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ isset($post->department->name) ? $post->department->name : '' }}</td>
                        <td>{{ isset($post->waste_type) ? $post->waste_type : '' }}</td>
                        <td>{{ isset($post->admission_date) ? $post->admission_date : '' }}</td>
                        <td>{{ isset($post->move_date) ? $post->move_date : '' }}</td>
                        <td>{{ isset($post->responsible_for_waste_doctor) ? $post->responsible_for_waste_doctor->getFullNameAttribute() : '' }}</td>
                    </tr>


                </table>

                    <br><br>
              <table>
                  <tr>
                      <th>Բժշկական թափոնի հանձնող</th>
                      <th>Բժշկական թափոնի ընդունող</th>
                  </tr>
                  <tr>
                      <td>{{ isset($post->waste_handler_doctor) ? $post->waste_handler_doctor->getFullNameAttribute() : '' }}</td>
                      <td>{{ isset($post->receiver_waste_doctor) ? $post->receiver_waste_doctor->getFullNameAttribute() : '' }}</td>

                  </tr>
              </table>

              <br><br>
                <table>

                        <th>Բժշկական թափոնի հանձնող</th>
                        <th>Բժշկական թափոնի ընդունողի ստորագրություն</th>
                        <th>Վթարային իրավիճակների գրանցում</th>
                        <th>Գրանցված վթարային իրավիճակի հաղորդման ամսաթիվ</th>
                        <th>Գրանցված վթարային իրավիճակի տեսակը/արտահոսք ծակոցներ և այլն</th>

                        <tr>
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
                    </tr>
                    <tr>
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
                    </tr>
                    <tr>
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
                    </tr>
                    <tr>
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
                    </tr>
                    <tr>
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
</body>
</html>

