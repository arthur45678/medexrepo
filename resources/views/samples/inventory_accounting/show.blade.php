<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/inventory_accounting.css')}}">
    <title>Վիրակապական պարագաների հաշվառում /ըստ հիվանդների/</title>
</head>
<body>
<div class="page-wrap">
    <div class="main-container">
        <div class="new-page">
            <br><br>
            <div class="text-center"><strong>Վիրակապական պարագաների հաշվառում /ըստ հիվանդների/</strong> </div>
            <br><br>

               <table>
                    <tr>
                        <th>Ամսաթիվ</th>
                        <th>Ա.Ա.Հ.</th>
                        <th>Մանիպուլացիա</th>
                        <th>Մուտքի ամսաթիվ</th>
                        <th>Վիրակապ.<br>
                            բուժքրոչ <br>
                            ստորա<br>
                            գրություն
                        </th>
                        <th>Ավագ բ/բ ստորագ րություն</th>
                        <th>որտէղից է <br>
                            ստացել
                        </th>
                        <th>վիրակապ․ <br>
                            նյութեր
                        </th>
                        <th>վիրակապ</th>
                    </tr>
                    <tr>
                        <td>{{$inac->date}}</td>
                        <td>{{$patient->full_name}}</td>
                        <td>{{$inac->manipulation}}</td>
                        <td>{{$inac->entry_date}}</td>
                        <td>{{$inac->bandage_nurse->full_name}}</td>
                        <td>{{$inac->chief_nurse->full_name}}</td>
                        <td>{{$inac->get_from}}</td>
                        <td>{{$inac->bandages}}</td>
                        <td>{{$inac->bandag}}</td>
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
                    </tr>
               </table>
                   <br><br><br>
               <table>
                    <tr>
                        <th>թանզիֆ</th>
                        <th>սպիրտ 96%</th>
                        <th>Զրաձնիպէրոքսիդ 33%</th>
                        <th>Պովիդոնյոդիդ 33%</th>
                        <th>նատրիքլոր 10%</th>
                        <th>ֆուրացիլին 1:5000</th>
                        <th>կպչուն սպէղանի</th>
                        <th>ձէռնոց</th>
                        <th>գլխավոր բ/բ ստրագ րություն</th>
                    </tr>
                    <tr>
                        <td>{{$inac->tanzif}}</td>
                        <td>{{$inac->alcohol}}</td>
                        <td>{{$inac->hydrogen_peroxide}}</td>
                        <td>{{$inac->povidonioditis}}</td>
                        <td>{{$inac->sodium_chloride}}</td>
                        <td>{{$inac->furacillin}}</td>
                        <td>{{$inac->adhesive_tape}}</td>
                        <td>{{$inac->glove}}</td>
                        <td>{{$inac->chief_nurse->full_name}}</td>
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
                    </tr>
                </table>
        </div>
      </div>
   </div>
</body>
</html>