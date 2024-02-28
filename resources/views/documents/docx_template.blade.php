<html>

<head>
    <meta charset="utf-8" />
    <style>
        body {
            font-family: DejaVu Sans;
        }

        td {
            border-right: 1px solid #000;
            padding: 20px;
            margin-left: 20px;
            margin-right: 20px;
            text-align: center;
        }
    </style>
</head>

<body>

    <table>
        <tbody>
            <tr>
                <td>
                    <h4>ՀՀ․ ԱՆ Վ․Ա․ Ֆանարջյանի անվան Ուռուցքաբանական Ազգային Կենտրոն ՓԲԸ</h4>
                    <p>Հեռ․ 28-70-52</p>
                </td>
                <td>
                    <h4>Ամբուլատոր քարտ N {{ $card_number }}</h4>
                    <p>Ազգանուն - {{ $patient_last_name }}</p>
                    <p>Անուն - {{ $patient_first_name }}</p>
                    <p>Հայրանուն - {{ $patient_father_name }}</p>
                    <p>Ծննդյան թիվը - {{ $patient_birth_date }}</p>
                    <p>Բնակավայր, մարզ - {{ $patient_settlement }}</p>
                    <p>Քաղաք, գյուղ - {{ $patient_city }}</p>
                </td>
                <td>
                    <p>
                        Խումբ - {{$cancer_type}}
                    </p>
                    <p style="text-align: right">
                        {{$patient_gender}}
                    </p>
                    <p>
                        {{$text}}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- <div class="card-heading">
        <div>
            <h4>ՀՀ․ ԱՆ Վ․Ա․ Ֆանարջյանի անվան Ուռուցքաբանական Ազգային Կենտրոն ՓԲԸ</h4>
            <p>Հեռ․ 28-70-52</p>
        </div>
        <div>
            <h4>Ամբուլատոր քարտ N {{ $card_number }}</h4>
    <p>Ազգանուն - {{ $patient_last_name }}</p>
    <p>Անուն - {{ $patient_first_name }}</p>
    <p>Հայրանուն - {{ $patient_father_name }}</p>
    <p>Ծննդյան թիվը - {{ $patient_birth_date }}</p>
    <p>Բնակավայր, մարզ - {{ $patient_settlement }}</p>
    <p>Քաղաք, գյուղ - {{ $patient_city }}</p>
    </div>
    <div>
        <p>
            <span>
                Խումբ - {{$cancer_type}}
            </span>
            <span class="float-right">
                {{$patient_gender}}
            </span>
        </p>
        <p>
            {{$text}}
        </p>
    </div>
    </div> --}}

</body>

</html>
