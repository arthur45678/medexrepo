<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/procurement_technical_characteristics.css')}}">
    <title>Document</title>
</head>

<body >
<div class="page-wrap" >
        <div class="main-container" >
            <div class="new-page" style="height: 2300mm">
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

                <div class="table-deg">
{{--                    <table style="transform: rotate(90deg);">--}}
                    <table >
                        <tr>
                            <td rowspan="2">Հրավերով նախատեսված չափաբաժնի համարը</td>
                            <td rowspan="2">Գնումների պլանով <br> նախատեսված միջանցիկ ծածկագիրը ըստ ԳՄԱ դասկարգման (CPV)</td>
                            <td rowspan="2">Անվանումը և ապրանքային նշանը</td>
                            <td rowspan="2">Արտադրողի անվանումը և ծագման երկիրը</td>
                            <td rowspan="2">Տեխնիկական բնութագիրը</td>
                            <td rowspan="2">Չափման միավորը</td>
                            <td rowspan="2">Միավոր գինը ՀՀ դրամ</td>
                            <td rowspan="2">Ընդհանուր գինը ՀՀ դրամ</td>
                            <td rowspan="2">Ընդհանուր քանակը</td>
                            <td colspan="3">ՄԱՏԱԿԱՐԱՐՈՒՄ</td>

                        </tr>
                        <tr>
                            <td>Հասցե</td>
                            <td>Ենթակա քանակներ</td>
                            <td>Ժամկետներ</td>

                        </tr>
                        @foreach($procurement as $procurements)
                            <tr>
                                <td>{{$procurements['invitation_quota_number']}}</td>
                                <td>{{$procurements['procurement_plan_passcode']}}</td>
                                <td>{{$procurements['name_and_trademark']}}</td>
                                <td>{{$procurements['manufacturer_name_and_country']}}</td>
                                <td>{{$procurements['technical_specifications']}}</td>
                                <td>{{$procurements['measurement_unit']}}</td>
                                <td>{{$procurements['unit_price']}}</td>
                                <td>{{$procurements['total_price']}}</td>
                                <td>{{$procurements['total_quantity']}}</td>

                                <td>{{$procurements['address']}}</td>
                                <td>{{$procurements['quantities']}}</td>
                                <td>{{$procurements['deadlines']}}</td>



                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="6">Ընդհանուր</td>
                                <td>{{$procurement->sum('unit_price')}}</td>
                                <td>{{$procurement->sum('total_price')}}</td>
                                <td >{{$procurement->sum('total_quantity')}}</td>
                                <td>-</td>
                                <td >{{$procurement->sum('quantities')}}</td>
                                <td>-</td>


                            </tr>

{{--                        <tr>--}}
{{--                            <td>25</td>--}}
{{--                            <td>26</td>--}}
{{--                            <td>27</td>--}}
{{--                            <td>28</td>--}}
{{--                            <td>29</td>--}}
{{--                            <td>30</td>--}}
{{--                            <td>31</td>--}}
{{--                            <td>32</td>--}}
{{--                            <td>33</td>--}}
{{--                            <td>34</td>--}}
{{--                            <td>35</td>--}}
{{--                            <td>36</td>--}}

{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>37</td>--}}
{{--                            <td>38</td>--}}
{{--                            <td>39</td>--}}
{{--                            <td>40</td>--}}
{{--                            <td>41</td>--}}
{{--                            <td>42</td>--}}
{{--                            <td>43</td>--}}
{{--                            <td>44</td>--}}
{{--                            <td>45</td>--}}
{{--                            <td>46</td>--}}
{{--                            <td>47</td>--}}
{{--                            <td>48</td>--}}

{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td colspan="7">Ընդհանուր</td>--}}
{{--                            <td>56</td>--}}
{{--                            <td>57</td>--}}
{{--                            <td>58</td>--}}
{{--                            <td>59</td>--}}
{{--                            <td>60</td>--}}

{{--                        </tr>--}}
                    </table>
                </div>
        </div>
    </div>
</div>
</body>
</html>
