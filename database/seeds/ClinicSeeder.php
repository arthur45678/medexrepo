<?php

use Illuminate\Database\Seeder;
use App\Models\Clinic;

class ClinicSeeder extends Seeder
{
    // public $clinics = [
    //     '1 Հիվանդանոց',
    //     '2 Գրիգոր Լուսավորչի անվան Հիվանդանոց',
    //     '3 Պողոս Մուկուչյանի անվան Հիվանդանոց',
    //     '4 Կարո-Մարո Պողոսյաններ կլինիկա',
    //     '5 Չարբախի ուռուցքաբանական Հիվանդանոց',
    // ];



    public $clinics_array = array(
        0 =>
        array(
            'regular_id' => 1,
            'name' => 'Կոշի ԲԱ ՓԲԸ',
            'code' => '56250',
            'status' => 'active',
        ),
        1 =>
        array(
            'regular_id' => 2,
            'name' => 'Օշականի ԲԱ ՓԲԸ',
            'code' => '56251',
            'status' => 'active',
        ),
        2 =>
        array(
            'regular_id' => 3,
            'name' => 'Ոսկեվազի ԲԱ ՓԲԸ',
            'code' => '56252',
            'status' => 'active',
        ),
        3 =>
        array(
            'regular_id' => 4,
            'name' => 'Կարբիի ԲԱ ՓԲԸ',
            'code' => '56254',
            'status' => 'active',
        ),
        4 =>
        array(
            'regular_id' => 5,
            'name' => 'Փարպիի ԲԱ ՓԲԸ',
            'code' => '56255',
            'status' => 'active',
        ),
        5 =>
        array(
            'regular_id' => 6,
            'name' => 'Սասունիկի ԲԱ ՓԲԸ',
            'code' => '56256',
            'status' => 'active',
        ),
        6 =>
        array(
            'regular_id' => 7,
            'name' => 'ՈՒջանի ԲԱ ՓԲԸ',
            'code' => '56257',
            'status' => 'active',
        ),
        7 =>
        array(
            'regular_id' => 8,
            'name' => 'Արուճի ԲԱ ՓԲԸ',
            'code' => '56259',
            'status' => 'active',
        ),
        8 =>
        array(
            'regular_id' => 9,
            'name' => 'Ագարակի ԲԱ ՓԲԸ',
            'code' => '56261',
            'status' => 'active',
        ),
        9 =>
        array(
            'regular_id' => 10,
            'name' => 'Ուշիի ԱԱՊԿ ՓԲԸ',
            'code' => '56262',
            'status' => 'active',
        ),
        10 =>
        array(
            'regular_id' => 11,
            'name' => 'Աշտարակի ԲԿ ՓԲԸ',
            'code' => '56032',
            'status' => 'active',
        ),
        11 =>
        array(
            'regular_id' => 12,
            'name' => 'Բյուրականի ԲԱ ՓԲԸ',
            'code' => '56253',
            'status' => 'active',
        ),
        12 =>
        array(
            'regular_id' => 13,
            'name' => 'Արագածի ԱԿ ՓԲԸ /Ապարան/',
            'code' => '49065',
            'status' => 'active',
        ),
        13 =>
        array(
            'regular_id' => 14,
            'name' => 'Քուչակի ԲԱ ՓԲԸ',
            'code' => '49251',
            'status' => 'active',
        ),
        14 =>
        array(
            'regular_id' => 15,
            'name' => 'Շենավանի ԲԱ ՓԲԸ',
            'code' => '49253',
            'status' => 'active',
        ),
        15 =>
        array(
            'regular_id' => 16,
            'name' => 'Ապարանի ԲԿ ՓԲԸ',
            'code' => '49032',
            'status' => 'active',
        ),
        16 =>
        array(
            'regular_id' => 17,
            'name' => 'Ծաղկահովիտի ԲԿ ՓԲԸ',
            'code' => '50032',
            'status' => 'active',
        ),
        17 =>
        array(
            'regular_id' => 18,
            'name' => '"Նարեկ" ԱԿ ՍՊԸ',
            'code' => '94257',
            'status' => 'active',
        ),
        18 =>
        array(
            'regular_id' => 19,
            'name' => 'Արտենի ԱԿ ՓԲԸ',
            'code' => '94065',
            'status' => 'active',
        ),
        19 =>
        array(
            'regular_id' => 20,
            'name' => 'Ներքին Բազմաբերդի ԲԱ ՓԲԸ',
            'code' => '94250',
            'status' => 'active',
        ),
        20 =>
        array(
            'regular_id' => 21,
            'name' => 'Մաստարայի ԲԱ ՓԲԸ',
            'code' => '94251',
            'status' => 'active',
        ),
        21 =>
        array(
            'regular_id' => 22,
            'name' => 'Արագածավանի ԲԱ ՓԲԸ',
            'code' => '94256',
            'status' => 'active',
        ),
        22 =>
        array(
            'regular_id' => 23,
            'name' => 'Թալինի ԲԿ ՓԲԸ',
            'code' => '94032',
            'status' => 'active',
        ),
        23 =>
        array(
            'regular_id' => 24,
            'name' => '"Ակադեմ. Ա. Հայրիյանի անվ. Արմաշի" ԱԿ ՓԲԸ',
            'code' => '13065',
            'status' => 'active',
        ),
        24 =>
        array(
            'regular_id' => 25,
            'name' => 'ՈԿՖ Բանավանի ԱԱՊԿ ՓԲԸ',
            'code' => '13240',
            'status' => 'active',
        ),
        25 =>
        array(
            'regular_id' => 26,
            'name' => 'Ավշարի ԲԱ ՓԲԸ',
            'code' => '13250',
            'status' => 'active',
        ),
        26 =>
        array(
            'regular_id' => 27,
            'name' => 'Զանգակատան ԱԱՊԿ ՓԲԸ',
            'code' => '13253',
            'status' => 'active',
        ),
        27 =>
        array(
            'regular_id' => 28,
            'name' => 'Սուրենավանի ԲԱ ՓԲԸ',
            'code' => '13254',
            'status' => 'active',
        ),
        28 =>
        array(
            'regular_id' => 29,
            'name' => 'Արարատի ԲԿ ՓԲԸ',
            'code' => '13031',
            'status' => 'active',
        ),
        29 =>
        array(
            'regular_id' => 30,
            'name' => 'Արարատի ԲԱ ՓԲԸ',
            'code' => '13251',
            'status' => 'active',
        ),
        30 =>
        array(
            'regular_id' => 31,
            'name' => 'Ներքին Դվինի ԱԱՊԿ ՓԲԸ',
            'code' => '52250',
            'status' => 'active',
        ),
        31 =>
        array(
            'regular_id' => 32,
            'name' => 'Արևշատի ԱԱՊԿ ՓԲԸ',
            'code' => '52251',
            'status' => 'active',
        ),
        32 =>
        array(
            'regular_id' => 33,
            'name' => 'Նշավանի ԱԱՊԿ ՓԲԸ',
            'code' => '52252',
            'status' => 'active',
        ),
        33 =>
        array(
            'regular_id' => 34,
            'name' => 'Այգեզարդի ԱԱՊԿ ՓԲԸ',
            'code' => '52253',
            'status' => 'active',
        ),
        34 =>
        array(
            'regular_id' => 35,
            'name' => 'Շահումյան ԲԱ ՓԲԸ',
            'code' => '52254',
            'status' => 'active',
        ),
        35 =>
        array(
            'regular_id' => 36,
            'name' => 'Բուրաստանի ԱԱՊԿ ՓԲԸ',
            'code' => '52255',
            'status' => 'active',
        ),
        36 =>
        array(
            'regular_id' => 37,
            'name' => 'Ազատավանի ԱԱՊԿ ՓԲԸ',
            'code' => '52256',
            'status' => 'active',
        ),
        37 =>
        array(
            'regular_id' => 38,
            'name' => 'Գետազատի ԱԱՊԿ ՓԲԸ',
            'code' => '52257',
            'status' => 'active',
        ),
        38 =>
        array(
            'regular_id' => 39,
            'name' => 'Դալարի ԱԱՊԿ ՓԲԸ',
            'code' => '52258',
            'status' => 'active',
        ),
        39 =>
        array(
            'regular_id' => 40,
            'name' => 'Մխչյանի ԲԱ ՓԲԸ',
            'code' => '52259',
            'status' => 'active',
        ),
        40 =>
        array(
            'regular_id' => 41,
            'name' => 'Քաղցրաշենի ԱԱՊԿ ՓԲԸ',
            'code' => '52260',
            'status' => 'active',
        ),
        41 =>
        array(
            'regular_id' => 42,
            'name' => 'Նորաշենի ԱԱՊԿ ՓԲԸ',
            'code' => '52261',
            'status' => 'active',
        ),
        42 =>
        array(
            'regular_id' => 43,
            'name' => 'Ջրաշենի ԱԱՊԿ ՓԲԸ',
            'code' => '52263',
            'status' => 'active',
        ),
        43 =>
        array(
            'regular_id' => 44,
            'name' => 'Մրգավանի ԲԱ ՓԲԸ',
            'code' => '52265',
            'status' => 'active',
        ),
        44 =>
        array(
            'regular_id' => 45,
            'name' => 'Կանաչուտի ԱԱՊԿ ՓԲԸ',
            'code' => '52266',
            'status' => 'active',
        ),
        45 =>
        array(
            'regular_id' => 46,
            'name' => 'Դիմիտրովի ԱԱՊԿ ՓԲԸ',
            'code' => '52267',
            'status' => 'active',
        ),
        46 =>
        array(
            'regular_id' => 47,
            'name' => 'Այգեստանի ԱԱՊԿ ՓԲԸ',
            'code' => '52268',
            'status' => 'active',
        ),
        47 =>
        array(
            'regular_id' => 48,
            'name' => 'Վերին Արտաշատի ԲԱ ՓԲԸ',
            'code' => '52269',
            'status' => 'active',
        ),
        48 =>
        array(
            'regular_id' => 49,
            'name' => 'Վերին Դվինի ԲԱ ՓԲԸ',
            'code' => '52270',
            'status' => 'active',
        ),
        49 =>
        array(
            'regular_id' => 50,
            'name' => 'Արտաշատի ԲԿ ՓԲԸ',
            'code' => '52032',
            'status' => 'active',
        ),
        50 =>
        array(
            'regular_id' => 51,
            'name' => '"Մասիս" օրթոպեդիկ հիվանդանոց ՓԲԸ',
            'code' => '41028',
            'status' => 'active',
        ),
        51 =>
        array(
            'regular_id' => 52,
            'name' => 'Սայաթ-Նովայի ԱԱՊԿ ՓԲԸ',
            'code' => '77250',
            'status' => 'active',
        ),
        52 =>
        array(
            'regular_id' => 53,
            'name' => 'Հայանիստի ԱԱՊԿ ՓԲԸ',
            'code' => '77251',
            'status' => 'active',
        ),
        53 =>
        array(
            'regular_id' => 54,
            'name' => 'Դարակերտի ԱԱՊԿ ՓԲԸ',
            'code' => '77252',
            'status' => 'active',
        ),
        54 =>
        array(
            'regular_id' => 55,
            'name' => 'Հովտաշատի ԱԱՊԿ ՓԲԸ',
            'code' => '77253',
            'status' => 'active',
        ),
        55 =>
        array(
            'regular_id' => 56,
            'name' => 'Արբաթի ԲԱ ՓԲԸ',
            'code' => '77254',
            'status' => 'active',
        ),
        56 =>
        array(
            'regular_id' => 57,
            'name' => 'Մարմարաշենի ԱԱՊԿ ՓԲԸ',
            'code' => '77255',
            'status' => 'active',
        ),
        57 =>
        array(
            'regular_id' => 58,
            'name' => 'Այնթապի ԲԱ ՓԲԸ',
            'code' => '77256',
            'status' => 'active',
        ),
        58 =>
        array(
            'regular_id' => 59,
            'name' => 'Արգավանդի ԱԱՊԿ ՓԲԸ',
            'code' => '77257',
            'status' => 'active',
        ),
        59 =>
        array(
            'regular_id' => 60,
            'name' => 'Գեղանիստի ԱԱՊԿ ՓԲԸ',
            'code' => '77258',
            'status' => 'active',
        ),
        60 =>
        array(
            'regular_id' => 61,
            'name' => 'Նորամարգի ԱԱՊԿ ՓԲԸ',
            'code' => '77262',
            'status' => 'active',
        ),
        61 =>
        array(
            'regular_id' => 62,
            'name' => 'Ռանչպարի ԲԱ ՓԲԸ',
            'code' => '77263',
            'status' => 'active',
        ),
        62 =>
        array(
            'regular_id' => 63,
            'name' => 'Սիսի ԲԱ ՓԲԸ',
            'code' => '77265',
            'status' => 'active',
        ),
        63 =>
        array(
            'regular_id' => 64,
            'name' => 'Դաշտավանի ԱԱՊԿ ՓԲԸ',
            'code' => '77266',
            'status' => 'active',
        ),
        64 =>
        array(
            'regular_id' => 65,
            'name' => 'Նորաբացի ԱԱՊԿ ՓԲԸ',
            'code' => '77267',
            'status' => 'active',
        ),
        65 =>
        array(
            'regular_id' => 66,
            'name' => 'Նոր Խարբերդի ԱԱՊԿ ՓԲԸ',
            'code' => '77268',
            'status' => 'active',
        ),
        66 =>
        array(
            'regular_id' => 67,
            'name' => 'Խաչփարի ԲԱ ՓԲԸ',
            'code' => '77269',
            'status' => 'active',
        ),
        67 =>
        array(
            'regular_id' => 68,
            'name' => 'Մասիսի ԲԿ ՓԲԸ',
            'code' => '77032',
            'status' => 'active',
        ),
        68 =>
        array(
            'regular_id' => 69,
            'name' => 'Այգավանի ԲԱ ՓԲԸ',
            'code' => '51251',
            'status' => 'active',
        ),
        69 =>
        array(
            'regular_id' => 70,
            'name' => 'Ոսկետափի ԲԱ ՓԲԸ',
            'code' => '51253',
            'status' => 'active',
        ),
        70 =>
        array(
            'regular_id' => 71,
            'name' => 'ՈՒրցաձորի ԱԱՊԿ ՓԲԸ',
            'code' => '51254',
            'status' => 'active',
        ),
        71 =>
        array(
            'regular_id' => 72,
            'name' => 'Նոր Կյանքի ԲԱ ՓԲԸ',
            'code' => '51255',
            'status' => 'active',
        ),
        72 =>
        array(
            'regular_id' => 73,
            'name' => 'Լուսառատի ԲԱ ՓԲԸ',
            'code' => '51257',
            'status' => 'active',
        ),
        73 =>
        array(
            'regular_id' => 74,
            'name' => 'Փոքր Վեդու ԱԱՊԿ ՓԲԸ',
            'code' => '51260',
            'status' => 'active',
        ),
        74 =>
        array(
            'regular_id' => 75,
            'name' => 'Նոյակերտի ԱԱՊԿ ՓԲԸ',
            'code' => '51262',
            'status' => 'active',
        ),
        75 =>
        array(
            'regular_id' => 76,
            'name' => 'Արալեզի ԲԱ ՓԲԸ',
            'code' => '51263',
            'status' => 'active',
        ),
        76 =>
        array(
            'regular_id' => 77,
            'name' => 'Տափերականի ԲԱ ՓԲԸ',
            'code' => '51264',
            'status' => 'active',
        ),
        77 =>
        array(
            'regular_id' => 78,
            'name' => 'Վեդու ԲԿ ՓԲԸ',
            'code' => '51032',
            'status' => 'active',
        ),
        78 =>
        array(
            'regular_id' => 79,
            'name' => 'Վեդու ծննդատուն ՓԲԸ',
            'code' => '51780',
            'status' => 'active',
        ),
        79 =>
        array(
            'regular_id' => 80,
            'name' => 'Մեծամորի ԲԿ ՓԲԸ',
            'code' => '35140',
            'status' => 'active',
        ),
        80 =>
        array(
            'regular_id' => 81,
            'name' => '"Հիսուսի մանուկներ" պոլիկլինիկա ՓԲԸ',
            'code' => '57032',
            'status' => 'active',
        ),
        81 =>
        array(
            'regular_id' => 82,
            'name' => 'Դալարիկի ԲԱ ՓԲԸ',
            'code' => '57250',
            'status' => 'active',
        ),
        82 =>
        array(
            'regular_id' => 83,
            'name' => 'Քարակերտի ԲԱ ՓԲԸ',
            'code' => '57251',
            'status' => 'active',
        ),
        83 =>
        array(
            'regular_id' => 84,
            'name' => 'Հուշակերտի ԲԱ ՊՓԲԸ',
            'code' => '57253',
            'status' => 'active',
        ),
        84 =>
        array(
            'regular_id' => 85,
            'name' => 'Լեռնագոգի ԲԱ ՓԲԸ',
            'code' => '57254',
            'status' => 'active',
        ),
        85 =>
        array(
            'regular_id' => 86,
            'name' => 'Բաղրամյան 1 ԲԱ ՊՓԲԸ',
            'code' => '57255',
            'status' => 'active',
        ),
        86 =>
        array(
            'regular_id' => 87,
            'name' => 'Երվանդաշատի ԲԱ ՓԲԸ',
            'code' => '57256',
            'status' => 'active',
        ),
        87 =>
        array(
            'regular_id' => 88,
            'name' => 'Արմավիրի ԲԿ ՊՓԲԸ',
            'code' => '83032',
            'status' => 'active',
        ),
        88 =>
        array(
            'regular_id' => 89,
            'name' => 'Գետաշենի ԲԱ ՓԲԸ',
            'code' => '83251',
            'status' => 'active',
        ),
        89 =>
        array(
            'regular_id' => 90,
            'name' => 'Արգավանդ ԲԱ ՓԲԸ',
            'code' => '83252',
            'status' => 'active',
        ),
        90 =>
        array(
            'regular_id' => 91,
            'name' => 'Բամբակաշատի ԲԱ ՓԲԸ',
            'code' => '83253',
            'status' => 'active',
        ),
        91 =>
        array(
            'regular_id' => 92,
            'name' => 'Նալբանդյանի ԲԱ ՓԲԸ',
            'code' => '83254',
            'status' => 'active',
        ),
        92 =>
        array(
            'regular_id' => 93,
            'name' => 'Հոկտեմբեր ԲԱ ՓԲԸ',
            'code' => '83255',
            'status' => 'active',
        ),
        93 =>
        array(
            'regular_id' => 94,
            'name' => 'Նոր-Արտագերսի ԲԱ ՓԲԸ',
            'code' => '83256',
            'status' => 'active',
        ),
        94 =>
        array(
            'regular_id' => 95,
            'name' => 'Շենավանի ԲԱ ՓԲԸ',
            'code' => '83257',
            'status' => 'active',
        ),
        95 =>
        array(
            'regular_id' => 96,
            'name' => 'Հացիկի ԲԱ ՓԲԸ',
            'code' => '83259',
            'status' => 'active',
        ),
        96 =>
        array(
            'regular_id' => 97,
            'name' => 'Զարթոնքի ԲԱ ՓԲԸ',
            'code' => '83262',
            'status' => 'active',
        ),
        97 =>
        array(
            'regular_id' => 98,
            'name' => 'Փշատավանի ԲԱ ՓԲԸ',
            'code' => '83263',
            'status' => 'active',
        ),
        98 =>
        array(
            'regular_id' => 99,
            'name' => 'Մրգաշատի ԲԱ ՓԲԸ',
            'code' => '83265',
            'status' => 'active',
        ),
        99 =>
        array(
            'regular_id' => 100,
            'name' => 'Խանջյանի ԲԱ ՓԲԸ',
            'code' => '83266',
            'status' => 'active',
        ),
        100 =>
        array(
            'regular_id' => 101,
            'name' => 'Մայիսյանի ԲՄ ՓԲԸ',
            'code' => '83267',
            'status' => 'active',
        ),
        101 =>
        array(
            'regular_id' => 102,
            'name' => 'Այգևանի ԲԱ ՓԲԸ',
            'code' => '83269',
            'status' => 'active',
        ),
        102 =>
        array(
            'regular_id' => 103,
            'name' => 'Ալաշկերտի ԲԱ ՓԲԸ',
            'code' => '83270',
            'status' => 'active',
        ),
        103 =>
        array(
            'regular_id' => 104,
            'name' => 'Արևիկի ԲԱ ՓԲԸ',
            'code' => '83272',
            'status' => 'active',
        ),
        104 =>
        array(
            'regular_id' => 105,
            'name' => 'Տանձուտի ԲԱ ՓԲԸ',
            'code' => '83274',
            'status' => 'active',
        ),
        105 =>
        array(
            'regular_id' => 106,
            'name' => 'Արմավիրի ԲԱ ՓԲԸ',
            'code' => '83275',
            'status' => 'active',
        ),
        106 =>
        array(
            'regular_id' => 107,
            'name' => 'Լենուղու ԲԱ ՓԲԸ',
            'code' => '83276',
            'status' => 'active',
        ),
        107 =>
        array(
            'regular_id' => 108,
            'name' => 'Մարգարայի ԲԱ ՓԲԸ',
            'code' => '83277',
            'status' => 'active',
        ),
        108 =>
        array(
            'regular_id' => 109,
            'name' => 'Վարդանաշենի ԲԱ ՓԲԸ',
            'code' => '83278',
            'status' => 'active',
        ),
        109 =>
        array(
            'regular_id' => 110,
            'name' => 'Ջանֆիդայի ԲԱ ՓԲԸ',
            'code' => '83279',
            'status' => 'active',
        ),
        110 =>
        array(
            'regular_id' => 111,
            'name' => 'Նորապատի ԲԱ ՓԲԸ',
            'code' => '83280',
            'status' => 'active',
        ),
        111 =>
        array(
            'regular_id' => 112,
            'name' => '"Հալեմի" ՍՊԸ',
            'code' => '83790',
            'status' => 'active',
        ),
        112 =>
        array(
            'regular_id' => 113,
            'name' => 'Այգեշատի ԲԱ ՓԲԸ',
            'code' => '83791',
            'status' => 'active',
        ),
        113 =>
        array(
            'regular_id' => 114,
            'name' => 'Վաղարշապատի հիվանդանոց ՊՓԲԸ',
            'code' => '99032',
            'status' => 'active',
        ),
        114 =>
        array(
            'regular_id' => 115,
            'name' => 'Վաղարշապատի պոլիկլինիկա ՊՓԲԸ',
            'code' => '99155',
            'status' => 'active',
        ),
        115 =>
        array(
            'regular_id' => 116,
            'name' => 'Նորակերտի ԲԱ ՊՓԲԸ',
            'code' => '99250',
            'status' => 'active',
        ),
        116 =>
        array(
            'regular_id' => 117,
            'name' => 'Աղավնատան ԲԱ ՓԲԸ',
            'code' => '99251',
            'status' => 'active',
        ),
        117 =>
        array(
            'regular_id' => 118,
            'name' => 'Մուսալեռի ԲԱ ՓԲԸ',
            'code' => '99252',
            'status' => 'active',
        ),
        118 =>
        array(
            'regular_id' => 119,
            'name' => 'Փարաքարի ԲԱ ՓԲԸ',
            'code' => '99253',
            'status' => 'active',
        ),
        119 =>
        array(
            'regular_id' => 120,
            'name' => 'Գեղակերտ ԲԱ ՓԲԸ',
            'code' => '99254',
            'status' => 'active',
        ),
        120 =>
        array(
            'regular_id' => 121,
            'name' => 'Արշալույսի ԲԱ ՊՓԲԸ',
            'code' => '99255',
            'status' => 'active',
        ),
        121 =>
        array(
            'regular_id' => 122,
            'name' => 'Շահումյանի ԲԱ ՊՓԲԸ',
            'code' => '99256',
            'status' => 'active',
        ),
        122 =>
        array(
            'regular_id' => 123,
            'name' => 'Ակնալիքի ԲԱ ՊՓԲԸ',
            'code' => '99257',
            'status' => 'active',
        ),
        123 =>
        array(
            'regular_id' => 124,
            'name' => 'Ոսկեհատի ԲԱ ՊՓԲԸ',
            'code' => '99258',
            'status' => 'active',
        ),
        124 =>
        array(
            'regular_id' => 125,
            'name' => 'Մերձավանի ԲԱ ՊՓԲԸ',
            'code' => '99259',
            'status' => 'active',
        ),
        125 =>
        array(
            'regular_id' => 126,
            'name' => 'Բաղրամյանի ԲԱ ՊՓԲԸ',
            'code' => '99260',
            'status' => 'active',
        ),
        126 =>
        array(
            'regular_id' => 127,
            'name' => 'Խորոնքի ԲԱ ՊՓԲԸ',
            'code' => '99261',
            'status' => 'active',
        ),
        127 =>
        array(
            'regular_id' => 128,
            'name' => 'Ջրառատի ԲԱ ՊՓԲԸ',
            'code' => '99262',
            'status' => 'active',
        ),
        128 =>
        array(
            'regular_id' => 129,
            'name' => 'Արագածի ԲԱ ՊՓԲԸ',
            'code' => '99263',
            'status' => 'active',
        ),
        129 =>
        array(
            'regular_id' => 130,
            'name' => 'Գայի ԲԱ ՊՓԲԸ',
            'code' => '99264',
            'status' => 'active',
        ),
        130 =>
        array(
            'regular_id' => 131,
            'name' => 'Առատաշենի ԲԱ ՊՓԲԸ',
            'code' => '99265',
            'status' => 'active',
        ),
        131 =>
        array(
            'regular_id' => 132,
            'name' => 'Հայթաղի ԲԱ ՊՓԲԸ',
            'code' => '99266',
            'status' => 'active',
        ),
        132 =>
        array(
            'regular_id' => 133,
            'name' => 'Ապագայի ԲԱ ՊՓԲԸ',
            'code' => '99267',
            'status' => 'active',
        ),
        133 =>
        array(
            'regular_id' => 134,
            'name' => 'Թաիրովի ԲԱ ՓԲԸ',
            'code' => '99269',
            'status' => 'active',
        ),
        134 =>
        array(
            'regular_id' => 135,
            'name' => 'Արաքսի ԲԱ ՊՓԲԸ',
            'code' => '99270',
            'status' => 'active',
        ),
        135 =>
        array(
            'regular_id' => 136,
            'name' => 'Գրիբոյեդովի ԲԱ ՊՓԲԸ',
            'code' => '99271',
            'status' => 'active',
        ),
        136 =>
        array(
            'regular_id' => 137,
            'name' => '"Տարոնիկ"',
            'code' => '99272',
            'status' => 'active',
        ),
        137 =>
        array(
            'regular_id' => 138,
            'name' => 'Վաղարշապատի ծննդատուն ՊՓԲԸ',
            'code' => '99780',
            'status' => 'active',
        ),
        138 =>
        array(
            'regular_id' => 139,
            'name' => '"Սևանի հոգեբուժական հիվանդանոց" ՓԲԸ',
            'code' => '41024',
            'status' => 'active',
        ),
        139 =>
        array(
            'regular_id' => 140,
            'name' => 'Վարդենիսի հիվանդանոց ՊՓԲԸ',
            'code' => '58032',
            'status' => 'active',
        ),
        140 =>
        array(
            'regular_id' => 141,
            'name' => 'Վարդենիսի պոլիկլինիկա ՓԲԸ',
            'code' => '58155',
            'status' => 'active',
        ),
        141 =>
        array(
            'regular_id' => 142,
            'name' => 'Ծովակ ԱԱՊԿ ՓԲԸ',
            'code' => '58254',
            'status' => 'active',
        ),
        142 =>
        array(
            'regular_id' => 143,
            'name' => 'Գեղամասար ԱԱՊԿ ՓԲԸ',
            'code' => '58256',
            'status' => 'active',
        ),
        143 =>
        array(
            'regular_id' => 144,
            'name' => 'Կարճաղբյուր ԱԱՊԿ ՓԲԸ',
            'code' => '58257',
            'status' => 'active',
        ),
        144 =>
        array(
            'regular_id' => 145,
            'name' => 'Մեծ Մասրիկի ԱԱՊԿ ՓԲԸ',
            'code' => '58258',
            'status' => 'active',
        ),
        145 =>
        array(
            'regular_id' => 146,
            'name' => 'Ակունքի ԱԱՊԿ ՓԲԸ',
            'code' => '58260',
            'status' => 'active',
        ),
        146 =>
        array(
            'regular_id' => 147,
            'name' => 'Լուսակունքի ԱԱՊԿ ՓԲԸ',
            'code' => '58261',
            'status' => 'active',
        ),
        147 =>
        array(
            'regular_id' => 148,
            'name' => 'Գավառի բժշկական կենտրոն ՓԲԸ',
            'code' => '70032',
            'status' => 'active',
        ),
        148 =>
        array(
            'regular_id' => 149,
            'name' => 'Գավառի պոլիկլինիկա ՊՓԲԸ',
            'code' => '70155',
            'status' => 'active',
        ),
        149 =>
        array(
            'regular_id' => 150,
            'name' => 'Նորատուսի ԲԱ ՊՓԲԸ',
            'code' => '70250',
            'status' => 'active',
        ),
        150 =>
        array(
            'regular_id' => 151,
            'name' => 'Սարուխանի ԲԱ ՊՓԲԸ',
            'code' => '70251',
            'status' => 'active',
        ),
        151 =>
        array(
            'regular_id' => 152,
            'name' => 'Կարմիր գյուղի ԲԱ ՊՓԲԸ',
            'code' => '70253',
            'status' => 'active',
        ),
        152 =>
        array(
            'regular_id' => 153,
            'name' => 'Լճափի ԱԱՊԿ ՓԲԸ',
            'code' => '70254',
            'status' => 'active',
        ),
        153 =>
        array(
            'regular_id' => 154,
            'name' => 'Գանձակի ԱԱՊԿ ՓԲԸ',
            'code' => '70255',
            'status' => 'active',
        ),
        154 =>
        array(
            'regular_id' => 155,
            'name' => 'Ճամբարակի առողջության կենտրոն ՓԲԸ',
            'code' => '74032',
            'status' => 'active',
        ),
        155 =>
        array(
            'regular_id' => 156,
            'name' => 'Դպրաբակի ԳԲԱ',
            'code' => '74250',
            'status' => 'active',
        ),
        156 =>
        array(
            'regular_id' => 157,
            'name' => 'Մարտունու ԲԿ ՓԲԸ',
            'code' => '76032',
            'status' => 'active',
        ),
        157 =>
        array(
            'regular_id' => 158,
            'name' => 'Վարդենիկի առողջության կենտրոն ՊՓԲԸ',
            'code' => '76065',
            'status' => 'active',
        ),
        158 =>
        array(
            'regular_id' => 159,
            'name' => 'Վերին Գետաշենի ԲԱ',
            'code' => '76250',
            'status' => 'active',
        ),
        159 =>
        array(
            'regular_id' => 160,
            'name' => 'Ներքին Գետաշենի ԲԱ ՊՓԲԸ',
            'code' => '76251',
            'status' => 'active',
        ),
        160 =>
        array(
            'regular_id' => 161,
            'name' => 'Ձորագյուղի ԲԱ ՊՓԲԸ',
            'code' => '76252',
            'status' => 'active',
        ),
        161 =>
        array(
            'regular_id' => 162,
            'name' => 'Զոլաքար ԲԱ ՓԲԸ',
            'code' => '76253',
            'status' => 'active',
        ),
        162 =>
        array(
            'regular_id' => 163,
            'name' => 'Գեղահովիտի ԱԱՊԿ ՓԲԸ',
            'code' => '76254',
            'status' => 'active',
        ),
        163 =>
        array(
            'regular_id' => 164,
            'name' => 'Ծովինարի ԲԱ ՊՓԲԸ',
            'code' => '76255',
            'status' => 'active',
        ),
        164 =>
        array(
            'regular_id' => 165,
            'name' => 'Երանոս ԲԱ ՓԲԸ',
            'code' => '76256',
            'status' => 'active',
        ),
        165 =>
        array(
            'regular_id' => 166,
            'name' => 'Վաղաշեն ԱԱՊԿ ՓԲԸ',
            'code' => '76257',
            'status' => 'active',
        ),
        166 =>
        array(
            'regular_id' => 167,
            'name' => 'Արծվանիստ ԱԱՊԿ ՓԲԸ',
            'code' => '76259',
            'status' => 'active',
        ),
        167 =>
        array(
            'regular_id' => 168,
            'name' => 'Աստղաձոր ԱԱՊԿ ՓԲԸ',
            'code' => '76261',
            'status' => 'active',
        ),
        168 =>
        array(
            'regular_id' => 169,
            'name' => 'Վարդաձորի ԱԱՊԿ ՓԲԸ',
            'code' => '76262',
            'status' => 'active',
        ),
        169 =>
        array(
            'regular_id' => 170,
            'name' => 'Լիճք ԱԱՊԿ ՓԲԸ',
            'code' => '76263',
            'status' => 'active',
        ),
        170 =>
        array(
            'regular_id' => 171,
            'name' => 'Ծովասարի ԱԱՊԿ ՓԲԸ',
            'code' => '76264',
            'status' => 'active',
        ),
        171 =>
        array(
            'regular_id' => 172,
            'name' => 'Ծակքարի ԱԱՊԿ ՓԲԸ',
            'code' => '76265',
            'status' => 'active',
        ),
        172 =>
        array(
            'regular_id' => 173,
            'name' => '"Մարտունու ծննդատուն" ՊՓԲԸ',
            'code' => '76780',
            'status' => 'active',
        ),
        173 =>
        array(
            'regular_id' => 174,
            'name' => 'Սևանի հիվանդանոց ՊՓԲԸ',
            'code' => '87032',
            'status' => 'active',
        ),
        174 =>
        array(
            'regular_id' => 175,
            'name' => 'Սևանի պոլիկլինիկա ՊՓԲԸ',
            'code' => '87155',
            'status' => 'active',
        ),
        175 =>
        array(
            'regular_id' => 176,
            'name' => 'Լճաշեն ԱԱՊԿ ՓԲԸ',
            'code' => '87250',
            'status' => 'active',
        ),
        176 =>
        array(
            'regular_id' => 177,
            'name' => 'Դդմաշենի ԲԱ',
            'code' => '87251',
            'status' => 'active',
        ),
        177 =>
        array(
            'regular_id' => 178,
            'name' => 'Ծովագյուղ ԱԱՊԿ ՓԲԸ',
            'code' => '87252',
            'status' => 'active',
        ),
        178 =>
        array(
            'regular_id' => 179,
            'name' => 'ԱՆԻՍ Ա/Ձ',
            'code' => '87301',
            'status' => 'active',
        ),
        179 =>
        array(
            'regular_id' => 180,
            'name' => 'Թիվ 2բուժ. միավորում ՓԲԸ',
            'code' => '01033',
            'status' => 'active',
        ),
        180 =>
        array(
            'regular_id' => 181,
            'name' => 'Թիվ 3 կլինիկական հիվանդանոց ՓԲԸ',
            'code' => '01034',
            'status' => 'active',
        ),
        181 =>
        array(
            'regular_id' => 182,
            'name' => '"Կարմիր բլուր" պոլիկլինիկա',
            'code' => '01035',
            'status' => 'active',
        ),
        182 =>
        array(
            'regular_id' => 183,
            'name' => '"Լեբեն" ՍՊԸ',
            'code' => '01036',
            'status' => 'active',
        ),
        183 =>
        array(
            'regular_id' => 184,
            'name' => '"Քանաքեռ Զեյթուն ծննդատուն" ՓԲԸ',
            'code' => '01037',
            'status' => 'active',
        ),
        184 =>
        array(
            'regular_id' => 185,
            'name' => '"Կառլեն Եսայանի անվան պոլիկլինիկա" ՓԲԸ',
            'code' => '01038',
            'status' => 'active',
        ),
        185 =>
        array(
            'regular_id' => 186,
            'name' => '"Մալաթիա" ԲԿ ՍՊԸ',
            'code' => '01039',
            'status' => 'active',
        ),
        186 =>
        array(
            'regular_id' => 187,
            'name' => '"Էրեբունի" ԲԿ ՓԲԸ',
            'code' => '01040',
            'status' => 'active',
        ),
        187 =>
        array(
            'regular_id' => 188,
            'name' => '"Շենգավիթ" ԲԿ ՓԲԸ',
            'code' => '01041',
            'status' => 'active',
        ),
        188 =>
        array(
            'regular_id' => 189,
            'name' => 'Քանաքեռ-Զեյթուն բժշկական կենտրոն ՓԲԸ',
            'code' => '01042',
            'status' => 'active',
        ),
        189 =>
        array(
            'regular_id' => 190,
            'name' => '"Սեբաստիա" ԲԿ ՍՊԸ',
            'code' => '01043',
            'status' => 'active',
        ),
        190 =>
        array(
            'regular_id' => 191,
            'name' => '"Նոր Արեշ" պոլիկլինիկա',
            'code' => '01044',
            'status' => 'active',
        ),
        191 =>
        array(
            'regular_id' => 192,
            'name' => '"Արաբկիր" մանկական պոլիկլինիկա ՓԲԸ',
            'code' => '01045',
            'status' => 'active',
        ),
        192 =>
        array(
            'regular_id' => 193,
            'name' => '"Արշակունյաց" պոլիկլինիկա',
            'code' => '01046',
            'status' => 'active',
        ),
        193 =>
        array(
            'regular_id' => 194,
            'name' => '"Սարի թաղ" պոլիկլինիկա',
            'code' => '01047',
            'status' => 'active',
        ),
        194 =>
        array(
            'regular_id' => 195,
            'name' => '"Սուրբ Աստվածածին" ծննդատուն',
            'code' => '01048',
            'status' => 'active',
        ),
        195 =>
        array(
            'regular_id' => 196,
            'name' => '"Թիվ 16" պոլիկլինիկա',
            'code' => '01052',
            'status' => 'active',
        ),
        196 =>
        array(
            'regular_id' => 197,
            'name' => '"Նուբարաշեն" պոլիկլինիկա',
            'code' => '01053',
            'status' => 'active',
        ),
        197 =>
        array(
            'regular_id' => 198,
            'name' => 'Նորք Մարաշ բժշկական կենտրոն ՓԲԸ',
            'code' => '01056',
            'status' => 'active',
        ),
        198 =>
        array(
            'regular_id' => 199,
            'name' => 'Քաղաքային հակատուբ. Դիսպանսեր',
            'code' => '01120',
            'status' => 'active',
        ),
        199 =>
        array(
            'regular_id' => 200,
            'name' => 'Քաղ, էնդոկրին դիսպանսեր',
            'code' => '01128',
            'status' => 'active',
        ),
        200 =>
        array(
            'regular_id' => 201,
            'name' => 'Թիվ 1 պոլիկլինիկա ՍՊՓԲԸ',
            'code' => '01155',
            'status' => 'active',
        ),
        201 =>
        array(
            'regular_id' => 202,
            'name' => 'Թիվ 4 պոլիկլինկա ՓԲԸ',
            'code' => '01158',
            'status' => 'active',
        ),
        202 =>
        array(
            'regular_id' => 203,
            'name' => 'Թիվ 5 պոլիկլինիկա ՓԲԸ',
            'code' => '01159',
            'status' => 'active',
        ),
        203 =>
        array(
            'regular_id' => 204,
            'name' => 'Թիվ 8 պոլիկլինիկա ՓԲԸ',
            'code' => '01162',
            'status' => 'active',
        ),
        204 =>
        array(
            'regular_id' => 205,
            'name' => 'Նոր Արաբկիր ԲԿ',
            'code' => '01165',
            'status' => 'active',
        ),
        205 =>
        array(
            'regular_id' => 206,
            'name' => 'Թիվ 12 պոլիկլինիկա ՓԲԸ',
            'code' => '01166',
            'status' => 'active',
        ),
        206 =>
        array(
            'regular_id' => 207,
            'name' => 'Թիվ 13 պոլիկլինիկա ՓԲԸ',
            'code' => '01167',
            'status' => 'active',
        ),
        207 =>
        array(
            'regular_id' => 208,
            'name' => 'Թիվ 15 պոլիկլինիկա ՓԲԸ',
            'code' => '01169',
            'status' => 'active',
        ),
        208 =>
        array(
            'regular_id' => 209,
            'name' => 'Թիվ 17 պոլիկլինիկա ՓԲԸ',
            'code' => '01171',
            'status' => 'active',
        ),
        209 =>
        array(
            'regular_id' => 210,
            'name' => 'Թիվ 19 պոլիկլինիկա ՓԲԸ',
            'code' => '01173',
            'status' => 'active',
        ),
        210 =>
        array(
            'regular_id' => 211,
            'name' => 'Թիվ 20 պոլիկլինիկա ՓԲԸ',
            'code' => '01174',
            'status' => 'active',
        ),
        211 =>
        array(
            'regular_id' => 212,
            'name' => 'Թիվ 22 պոլիկլինիկա ՓԲԸ',
            'code' => '01176',
            'status' => 'active',
        ),
        212 =>
        array(
            'regular_id' => 213,
            'name' => 'Նորագավիթ պոլիկլինիկա ՓԲԸ',
            'code' => '01179',
            'status' => 'active',
        ),
        213 =>
        array(
            'regular_id' => 214,
            'name' => 'Թիվ 9 մանկական պոլիկլինիկա ՓԲԸ',
            'code' => '01194',
            'status' => 'active',
        ),
        214 =>
        array(
            'regular_id' => 215,
            'name' => '"Ընտանիքի պլանավորման և սեռական ԱԿ" ՓԲԸ',
            'code' => '01781',
            'status' => 'active',
        ),
        215 =>
        array(
            'regular_id' => 216,
            'name' => 'Գրիգոր Նարեկացի ԲԿ ՓԲԸ',
            'code' => '01782',
            'status' => 'active',
        ),
        216 =>
        array(
            'regular_id' => 217,
            'name' => 'Սուրբ Աստվածամայր ԲԿ ՓԲԸ',
            'code' => '01785',
            'status' => 'active',
        ),
        217 =>
        array(
            'regular_id' => 218,
            'name' => 'Լ.Ա.Հովհաննիսյանի անվան սրտաբանության ԳՀԻ ՓԲԸ',
            'code' => '01960',
            'status' => 'active',
        ),
        218 =>
        array(
            'regular_id' => 219,
            'name' => 'Վանաձորի թիվ 1 հիվանդանոցային համալիր ՓԲԸ',
            'code' => '26041',
            'status' => 'active',
        ),
        219 =>
        array(
            'regular_id' => 220,
            'name' => 'Վանաձորի ինֆ. հիվանդանոց ՊՓԲԸ',
            'code' => '26090',
            'status' => 'active',
        ),
        220 =>
        array(
            'regular_id' => 221,
            'name' => 'Լոռու մարզի մարզ. հոգեբուժ. դիսպանսեր ՊՓԲԸ',
            'code' => '26122',
            'status' => 'active',
        ),
        221 =>
        array(
            'regular_id' => 222,
            'name' => 'Վանաձորի թիվ 1 պոլիկլինիկա ՊՓԲԸ',
            'code' => '26155',
            'status' => 'active',
        ),
        222 =>
        array(
            'regular_id' => 223,
            'name' => 'Վանաձորի թիվ 4 պոլիկլինիկա ՊՓԲԸ',
            'code' => '26156',
            'status' => 'active',
        ),
        223 =>
        array(
            'regular_id' => 224,
            'name' => 'Վանաձորի թիվ 5 պոլիկլինիկա ՊՓԲԸ',
            'code' => '26157',
            'status' => 'active',
        ),
        224 =>
        array(
            'regular_id' => 225,
            'name' => 'Վանաձորի թիվ 3 պոլիկլինիկա ՊՓԲԸ',
            'code' => '26158',
            'status' => 'active',
        ),
        225 =>
        array(
            'regular_id' => 226,
            'name' => 'Գուգարք կենտրոնական պոլիկլինիկա ՊՓԲԸ',
            'code' => '26159',
            'status' => 'active',
        ),
        226 =>
        array(
            'regular_id' => 227,
            'name' => 'Վանաձորի պետական բժշկական քոլեջ',
            'code' => '26947',
            'status' => 'active',
        ),
        227 =>
        array(
            'regular_id' => 228,
            'name' => 'Շահումյանի ԱԱՊԿ ՓԲԸ',
            'code' => '62252',
            'status' => 'active',
        ),
        228 =>
        array(
            'regular_id' => 229,
            'name' => 'Գուգարքի ԱԱՊԿ ՓԲԸ',
            'code' => '62253',
            'status' => 'active',
        ),
        229 =>
        array(
            'regular_id' => 230,
            'name' => 'Վահագնի առողջության կենտրոն ՊՓԲԸ',
            'code' => '62254',
            'status' => 'active',
        ),
        230 =>
        array(
            'regular_id' => 231,
            'name' => 'Մարգահովտի առողջության կենտրոն ՊՓԲԸ',
            'code' => '62255',
            'status' => 'active',
        ),
        231 =>
        array(
            'regular_id' => 232,
            'name' => 'Լեռնապատի առողջության կենտրոն ՊՓԲԸ',
            'code' => '62256',
            'status' => 'active',
        ),
        232 =>
        array(
            'regular_id' => 233,
            'name' => 'Տաշիրի բժշկական կենտռոն ՓԲԸ',
            'code' => '69032',
            'status' => 'active',
        ),
        233 =>
        array(
            'regular_id' => 234,
            'name' => 'Մեծավանի առողջության կենտրոն ՊՓԲԸ',
            'code' => '69065',
            'status' => 'active',
        ),
        234 =>
        array(
            'regular_id' => 235,
            'name' => 'Սպիտակի բժշկական կենտրոն ՓԲԸ',
            'code' => '90032',
            'status' => 'active',
        ),
        235 =>
        array(
            'regular_id' => 236,
            'name' => 'Մեծ Պարնիի առողջության կենտրոն ՊՓԲԸ',
            'code' => '90065',
            'status' => 'active',
        ),
        236 =>
        array(
            'regular_id' => 237,
            'name' => '"Ռեցեպտոր" ՍՊԸ',
            'code' => '90240',
            'status' => 'active',
        ),
        237 =>
        array(
            'regular_id' => 238,
            'name' => 'Ջրաշենի ԲԱ ՓԲԸ',
            'code' => '90250',
            'status' => 'active',
        ),
        238 =>
        array(
            'regular_id' => 239,
            'name' => 'Արևաշող ԱԱՊԿ ՓԲԸ',
            'code' => '90251',
            'status' => 'active',
        ),
        239 =>
        array(
            'regular_id' => 240,
            'name' => 'Ստեփանավանի բժշկական կենտրոն ՓԲԸ',
            'code' => '92032',
            'status' => 'active',
        ),
        240 =>
        array(
            'regular_id' => 241,
            'name' => 'Կուրթանի ԱԱՊԿ ՓԲԸ',
            'code' => '92250',
            'status' => 'active',
        ),
        241 =>
        array(
            'regular_id' => 242,
            'name' => 'Գյուլագարակի ԱԱՊԿ ՓԲԸ',
            'code' => '92251',
            'status' => 'active',
        ),
        242 =>
        array(
            'regular_id' => 243,
            'name' => 'Ագարակի ԱԱՊԿ ՓԲԸ',
            'code' => '92252',
            'status' => 'active',
        ),
        243 =>
        array(
            'regular_id' => 244,
            'name' => 'Ուռուտի ԱԱՊԿ ՓԲԸ',
            'code' => '92254',
            'status' => 'active',
        ),
        244 =>
        array(
            'regular_id' => 245,
            'name' => 'Գարգառ ԱԱՊԿ ՓԲԸ',
            'code' => '92256',
            'status' => 'active',
        ),
        245 =>
        array(
            'regular_id' => 246,
            'name' => 'Վարդաբլուրի ԲԱ ՓԲԸ',
            'code' => '92257',
            'status' => 'active',
        ),
        246 =>
        array(
            'regular_id' => 247,
            'name' => 'Ալավերդու բժշկական կենտրոն ՓԲԸ',
            'code' => '96035',
            'status' => 'active',
        ),
        247 =>
        array(
            'regular_id' => 248,
            'name' => 'Դսեղի առողջության կենտրոն ՓԲԸ',
            'code' => '96065',
            'status' => 'active',
        ),
        248 =>
        array(
            'regular_id' => 249,
            'name' => 'Թումանյանի առողջության կենտրոն ՓԲԸ',
            'code' => '96240',
            'status' => 'active',
        ),
        249 =>
        array(
            'regular_id' => 250,
            'name' => 'Ախթալայի առողջության կենտրոն ՓԲԸ',
            'code' => '96241',
            'status' => 'active',
        ),
        250 =>
        array(
            'regular_id' => 251,
            'name' => 'Արևածագ ԲԱ',
            'code' => '96251',
            'status' => 'active',
        ),
        251 =>
        array(
            'regular_id' => 252,
            'name' => 'Ճոճկանի ԲԱ ՓԲԸ',
            'code' => '96252',
            'status' => 'active',
        ),
        252 =>
        array(
            'regular_id' => 253,
            'name' => 'Աքորի ԲԱ',
            'code' => '96253',
            'status' => 'active',
        ),
        253 =>
        array(
            'regular_id' => 254,
            'name' => 'Շնողի ԲԱ ՓԲԸ',
            'code' => '96254',
            'status' => 'active',
        ),
        254 =>
        array(
            'regular_id' => 255,
            'name' => 'Օձունի ԲԱ ՓԲԸ',
            'code' => '96255',
            'status' => 'active',
        ),
        255 =>
        array(
            'regular_id' => 256,
            'name' => 'Չարենցավանի ԲԿ ՓԲԸ',
            'code' => '39032',
            'status' => 'active',
        ),
        256 =>
        array(
            'regular_id' => 257,
            'name' => 'Ալափարսի ԱԱՊԿ ՓԲԸ',
            'code' => '39250',
            'status' => 'active',
        ),
        257 =>
        array(
            'regular_id' => 258,
            'name' => 'Արզականի ԲԱ ՊՓԲԸ',
            'code' => '39251',
            'status' => 'active',
        ),
        258 =>
        array(
            'regular_id' => 259,
            'name' => 'Բջնիի ԲԱ ՊՓԲԸ',
            'code' => '39252',
            'status' => 'active',
        ),
        259 =>
        array(
            'regular_id' => 260,
            'name' => '"Նևրոզ. և այլ սահմ.վիճ.հանր.կլինիկ. հիվ." ՓԲԸ',
            'code' => '41023',
            'status' => 'active',
        ),
        260 =>
        array(
            'regular_id' => 261,
            'name' => '"Հանրապետական հակատուբ. Դիսպանսեր" ՓԲԸ',
            'code' => '41110',
            'status' => 'active',
        ),
        261 =>
        array(
            'regular_id' => 262,
            'name' => 'Աբովյանի ԲԿ ՓԲԸ',
            'code' => '42032',
            'status' => 'active',
        ),
        262 =>
        array(
            'regular_id' => 263,
            'name' => '"Արզնու" երկաթ. հիվանդ. վերականգ. կենտրոն ՓԲԸ',
            'code' => '42033',
            'status' => 'active',
        ),
        263 =>
        array(
            'regular_id' => 264,
            'name' => '"ԱրզԷսթ" ՍՊԸ',
            'code' => '42034',
            'status' => 'active',
        ),
        264 =>
        array(
            'regular_id' => 265,
            'name' => 'Նոմամեդ ՍՊԸ',
            'code' => '42040',
            'status' => 'active',
        ),
        265 =>
        array(
            'regular_id' => 266,
            'name' => 'Գառնիի ԱԿ ՊՓԲԸ',
            'code' => '42065',
            'status' => 'active',
        ),
        266 =>
        array(
            'regular_id' => 267,
            'name' => 'Բյուրեղավանի քաղաղային պոլիկլինիկա ՓԲԸ',
            'code' => '42242',
            'status' => 'active',
        ),
        267 =>
        array(
            'regular_id' => 268,
            'name' => 'Արամուսի ԱԱՊԿ ՓԲԸ',
            'code' => '42252',
            'status' => 'active',
        ),
        268 =>
        array(
            'regular_id' => 269,
            'name' => 'Առինջի "Անահիտ Ծառուկյանի " ԲԱ ՓԲԸ',
            'code' => '42253',
            'status' => 'active',
        ),
        269 =>
        array(
            'regular_id' => 270,
            'name' => 'Բալահովիտի ԲԱ ՊՓԲԸ',
            'code' => '42254',
            'status' => 'active',
        ),
        270 =>
        array(
            'regular_id' => 271,
            'name' => 'Ջրվեժի ԲԱ ՓԲԸ',
            'code' => '42255',
            'status' => 'active',
        ),
        271 =>
        array(
            'regular_id' => 272,
            'name' => 'Զառի ԱԱՊԿ ՓԲԸ',
            'code' => '42256',
            'status' => 'active',
        ),
        272 =>
        array(
            'regular_id' => 273,
            'name' => 'Կոտայքի ԱԱՊԿ ՓԲԸ',
            'code' => '42257',
            'status' => 'active',
        ),
        273 =>
        array(
            'regular_id' => 274,
            'name' => 'Կապուտանի ԱԱՊԿ ՓԲԸ',
            'code' => '42258',
            'status' => 'active',
        ),
        274 =>
        array(
            'regular_id' => 275,
            'name' => 'Ձորաղբյուրի ԱԱՊԿ ՓԲԸ',
            'code' => '42259',
            'status' => 'active',
        ),
        275 =>
        array(
            'regular_id' => 276,
            'name' => 'Վերին Պտղնիի ԱԱՊԿ ՓԲԸ',
            'code' => '42260',
            'status' => 'active',
        ),
        276 =>
        array(
            'regular_id' => 277,
            'name' => 'Մայակովսկու ԱԱՊԿ ՓԲԸ',
            'code' => '42261',
            'status' => 'active',
        ),
        277 =>
        array(
            'regular_id' => 278,
            'name' => 'Գեղաշենի ԱԱՊԿ ՓԲԸ',
            'code' => '42263',
            'status' => 'active',
        ),
        278 =>
        array(
            'regular_id' => 279,
            'name' => 'Արզնիի ԲԱ ՊՓԲԸ',
            'code' => '42264',
            'status' => 'active',
        ),
        279 =>
        array(
            'regular_id' => 280,
            'name' => 'Ակունքի ԱԱՊԿ ՓԲԸ',
            'code' => '42266',
            'status' => 'active',
        ),
        280 =>
        array(
            'regular_id' => 281,
            'name' => '"Մարգարիտ" ՍՊԸ',
            'code' => '42272',
            'status' => 'active',
        ),
        281 =>
        array(
            'regular_id' => 282,
            'name' => '\'\'Կարդիոմեդ ընտան.բժշկ. կենտրոն\'\' ՍՊԸ',
            'code' => '42273',
            'status' => 'active',
        ),
        282 =>
        array(
            'regular_id' => 283,
            'name' => 'Աբովյանի ծննդատուն ՊՓԲԸ',
            'code' => '42780',
            'status' => 'active',
        ),
        283 =>
        array(
            'regular_id' => 284,
            'name' => 'Նաիրիի ԲԿ ՓԲԸ',
            'code' => '80032',
            'status' => 'active',
        ),
        284 =>
        array(
            'regular_id' => 285,
            'name' => 'Նոր-Հաճնի պոլիկլինիկա ՊՓԲԸ',
            'code' => '80156',
            'status' => 'active',
        ),
        285 =>
        array(
            'regular_id' => 286,
            'name' => 'Քասախի ԱԱՊԿ ՓԲԸ',
            'code' => '80250',
            'status' => 'active',
        ),
        286 =>
        array(
            'regular_id' => 287,
            'name' => 'Պռոշյանի ԱԱՊԿ ՓԲԸ',
            'code' => '80251',
            'status' => 'active',
        ),
        287 =>
        array(
            'regular_id' => 288,
            'name' => 'Նոր-Գեղիի ԱԱՊԿ ՓԲԸ',
            'code' => '80252',
            'status' => 'active',
        ),
        288 =>
        array(
            'regular_id' => 289,
            'name' => 'Նոր-Երզնկայի ԱԱՊԿ ՓԲԸ',
            'code' => '80253',
            'status' => 'active',
        ),
        289 =>
        array(
            'regular_id' => 290,
            'name' => 'Մրգաշենի ԱԱՊԿ ՓԲԸ',
            'code' => '80254',
            'status' => 'active',
        ),
        290 =>
        array(
            'regular_id' => 291,
            'name' => 'Քանաքեռավանի ԱԱՊԿ ՓԲԸ',
            'code' => '80255',
            'status' => 'active',
        ),
        291 =>
        array(
            'regular_id' => 292,
            'name' => 'Զովունու ԱԱՊԿ ՓԲԸ',
            'code' => '80256',
            'status' => 'active',
        ),
        292 =>
        array(
            'regular_id' => 293,
            'name' => 'Բուժականի ԲԱ ՊՓԲԸ',
            'code' => '80257',
            'status' => 'active',
        ),
        293 =>
        array(
            'regular_id' => 294,
            'name' => 'Արագյուղի ԱԱՊԿ ՓԲԸ',
            'code' => '80258',
            'status' => 'active',
        ),
        294 =>
        array(
            'regular_id' => 295,
            'name' => 'Արգելի ԲԱ ՓԲԸ',
            'code' => '80259',
            'status' => 'active',
        ),
        295 =>
        array(
            'regular_id' => 296,
            'name' => 'Հրազդանի ԲԿ ՓԲԸ',
            'code' => '85032',
            'status' => 'active',
        ),
        296 =>
        array(
            'regular_id' => 297,
            'name' => '"Էմբրիոն" ՍՊԸ',
            'code' => '85034',
            'status' => 'active',
        ),
        297 =>
        array(
            'regular_id' => 298,
            'name' => 'Ծաղկաձորի ԲԱ ՓԲԸ',
            'code' => '85240',
            'status' => 'active',
        ),
        298 =>
        array(
            'regular_id' => 299,
            'name' => 'Մեղրաձորի ԲԱ ՊՓԲԸ',
            'code' => '85251',
            'status' => 'active',
        ),
        299 =>
        array(
            'regular_id' => 300,
            'name' => 'Լեռնանիստի ԲԱ ՊՓԲԸ',
            'code' => '85253',
            'status' => 'active',
        ),
        300 =>
        array(
            'regular_id' => 301,
            'name' => 'Սոլակի ԱԱՊԿ ՓԲԸ',
            'code' => '85254',
            'status' => 'active',
        ),
        301 =>
        array(
            'regular_id' => 302,
            'name' => 'Քաղսիի ԱԱՊԿ ՓԲԸ',
            'code' => '85255',
            'status' => 'active',
        ),
        302 =>
        array(
            'regular_id' => 303,
            'name' => '"Ճերմակ հիվանդանոց" ՍՊԸ',
            'code' => '29032',
            'status' => 'active',
        ),
        303 =>
        array(
            'regular_id' => 304,
            'name' => '\'\'Գյումրիի\'\' ԲԿ ՓԲԸ',
            'code' => '29033',
            'status' => 'active',
        ),
        304 =>
        array(
            'regular_id' => 305,
            'name' => 'Սամարիթեր հիվանդանոց ՓԲԸ',
            'code' => '29036',
            'status' => 'active',
        ),
        305 =>
        array(
            'regular_id' => 306,
            'name' => '\'\'Գենրիխ Կյուրեղյան\'\' նյարդաբանական կենտրոն ՍՊԸ',
            'code' => '29037',
            'status' => 'active',
        ),
        306 =>
        array(
            'regular_id' => 307,
            'name' => 'Ավստրիական մանկական հիվանդանոց ՓԲԸ',
            'code' => '29055',
            'status' => 'active',
        ),
        307 =>
        array(
            'regular_id' => 308,
            'name' => 'Գյումրու ինֆեկցիոն և հակատուբ. հիվանդանոց ՓԲԸ',
            'code' => '29090',
            'status' => 'active',
        ),
        308 =>
        array(
            'regular_id' => 309,
            'name' => 'Գյումրու մաշկավեներ. և կոսմետ. կենտրոն ՍՊԸ',
            'code' => '29121',
            'status' => 'active',
        ),
        309 =>
        array(
            'regular_id' => 310,
            'name' => 'Գյումրու հոգեկան առողջության կենտրոն ՓԲԸ',
            'code' => '29122',
            'status' => 'active',
        ),
        310 =>
        array(
            'regular_id' => 311,
            'name' => 'Գյումրու ուռուցքաբանական դիսպանսեր ՓԲԸ',
            'code' => '29123',
            'status' => 'active',
        ),
        311 =>
        array(
            'regular_id' => 312,
            'name' => '"Էնրիկո Մատտեի անվան" պոլիկլինիկա ՓԲԸ',
            'code' => '29155',
            'status' => 'active',
        ),
        312 =>
        array(
            'regular_id' => 313,
            'name' => 'Գյումրիի թիվ 1 պոլիկլինիկա ՓԲԸ',
            'code' => '29156',
            'status' => 'active',
        ),
        313 =>
        array(
            'regular_id' => 314,
            'name' => 'Վ.Աբաջյանի անվան \'\'Ընտանեկան ԲԿ\'\' ՓԲԸ',
            'code' => '29157',
            'status' => 'active',
        ),
        314 =>
        array(
            'regular_id' => 315,
            'name' => 'Գյումրիի Կարմիր Խաչի պոլիկլինիկա ՓԲԸ',
            'code' => '29158',
            'status' => 'active',
        ),
        315 =>
        array(
            'regular_id' => 316,
            'name' => 'Գյումրիի թիվ 2 պոլիկլինիկա ՓԲԸ',
            'code' => '29159',
            'status' => 'active',
        ),
        316 =>
        array(
            'regular_id' => 317,
            'name' => 'Գյումրու վերականգնողական կենտրոն ՓԲԸ',
            'code' => '29160',
            'status' => 'active',
        ),
        317 =>
        array(
            'regular_id' => 318,
            'name' => '\'\'Բեռլին\'\' մոր և մանկան կենտրոն ՓԲԸ',
            'code' => '29161',
            'status' => 'active',
        ),
        318 =>
        array(
            'regular_id' => 319,
            'name' => '"Գյումրու ծննդատուն\'\' ՓԲԸ',
            'code' => '29780',
            'status' => 'active',
        ),
        319 =>
        array(
            'regular_id' => 320,
            'name' => 'Գյումրիի Պաթալոգոանատոմական լաբորատորիա ՓԲԸ',
            'code' => '29842',
            'status' => 'active',
        ),
        320 =>
        array(
            'regular_id' => 321,
            'name' => 'Ամասիայի ԱԿ ՓԲԸ',
            'code' => '46032',
            'status' => 'active',
        ),
        321 =>
        array(
            'regular_id' => 322,
            'name' => 'Մարալիկի ԱԿ ՓԲԸ',
            'code' => '48032',
            'status' => 'active',
        ),
        322 =>
        array(
            'regular_id' => 323,
            'name' => 'Աղինի ԱԿ ՓԲԸ',
            'code' => '48066',
            'status' => 'active',
        ),
        323 =>
        array(
            'regular_id' => 324,
            'name' => 'Սառնաղբյուրի ԲԱ ՓԲԸ',
            'code' => '48250',
            'status' => 'active',
        ),
        324 =>
        array(
            'regular_id' => 325,
            'name' => 'Անի-Պեմզայի ԲԱ ՓԲԸ',
            'code' => '48251',
            'status' => 'active',
        ),
        325 =>
        array(
            'regular_id' => 326,
            'name' => 'Արթիկի ԲԿ ՓԲԸ',
            'code' => '53032',
            'status' => 'active',
        ),
        326 =>
        array(
            'regular_id' => 327,
            'name' => 'Փանիկի ԲԱ ՓԲԸ',
            'code' => '53066',
            'status' => 'active',
        ),
        327 =>
        array(
            'regular_id' => 328,
            'name' => 'Հոռոմի ԲԱ ՓԲԸ',
            'code' => '53251',
            'status' => 'active',
        ),
        328 =>
        array(
            'regular_id' => 329,
            'name' => 'Պեմզաշենի ԲԱ ՓԲԸ',
            'code' => '53252',
            'status' => 'active',
        ),
        329 =>
        array(
            'regular_id' => 330,
            'name' => 'Մեծ Մանթաշի ԱԿ ՓԲԸ',
            'code' => '53253',
            'status' => 'active',
        ),
        330 =>
        array(
            'regular_id' => 331,
            'name' => '"Արթիկի մոր և մանկան" ԱՊԿ ՓԲԸ',
            'code' => '53780',
            'status' => 'active',
        ),
        331 =>
        array(
            'regular_id' => 332,
            'name' => 'Ախուրյանի ԲԿ ՓԲԸ',
            'code' => '55032',
            'status' => 'active',
        ),
        332 =>
        array(
            'regular_id' => 333,
            'name' => 'Ախուրյանի "Մոր և մանկան" ԱԿ հիմնադրամ',
            'code' => '55186',
            'status' => 'active',
        ),
        333 =>
        array(
            'regular_id' => 334,
            'name' => 'Ախուրիկի ԲԱ ՓԲԸ',
            'code' => '55250',
            'status' => 'active',
        ),
        334 =>
        array(
            'regular_id' => 335,
            'name' => 'Ազատանի ԲԱ ՓԲԸ',
            'code' => '55251',
            'status' => 'active',
        ),
        335 =>
        array(
            'regular_id' => 336,
            'name' => 'Ջաջուռի ԲԱ ՓԲԸ',
            'code' => '55253',
            'status' => 'active',
        ),
        336 =>
        array(
            'regular_id' => 337,
            'name' => 'Մարմաշենի ԲԱ ՓԲԸ',
            'code' => '55254',
            'status' => 'active',
        ),
        337 =>
        array(
            'regular_id' => 338,
            'name' => 'Մայիսյանի ԲԱ ՓԲԸ',
            'code' => '55255',
            'status' => 'active',
        ),
        338 =>
        array(
            'regular_id' => 339,
            'name' => '"Տիրամայր Նարեկ" հիվանդանոց ՍՊԸ',
            'code' => '63032',
            'status' => 'active',
        ),
        339 =>
        array(
            'regular_id' => 340,
            'name' => 'Գորիսի ԲԿ ՓԲԸ',
            'code' => '60032',
            'status' => 'active',
        ),
        340 =>
        array(
            'regular_id' => 341,
            'name' => 'Վերիշենի ԲԱ ՓԲԸ',
            'code' => '60250',
            'status' => 'active',
        ),
        341 =>
        array(
            'regular_id' => 342,
            'name' => 'Խնձորեսկի ԱԱՊԿ ՓԲԸ',
            'code' => '60251',
            'status' => 'active',
        ),
        342 =>
        array(
            'regular_id' => 343,
            'name' => 'Շինահայրի ԱԱՊԿ ՓԲԸ',
            'code' => '60254',
            'status' => 'active',
        ),
        343 =>
        array(
            'regular_id' => 344,
            'name' => 'Տաթևի ԲԱ ՓԲԸ',
            'code' => '60255',
            'status' => 'active',
        ),
        344 =>
        array(
            'regular_id' => 345,
            'name' => 'Տեղի ԱԱՊԿ ՓԲԸ',
            'code' => '60256',
            'status' => 'active',
        ),
        345 =>
        array(
            'regular_id' => 346,
            'name' => 'Ֆրանս-հայկական սրտանոթային կենտրոն ՊՀՀՄ',
            'code' => '60761',
            'status' => 'active',
        ),
        346 =>
        array(
            'regular_id' => 347,
            'name' => 'Քաջարանի ԲԿ ՓԲԸ',
            'code' => '72032',
            'status' => 'active',
        ),
        347 =>
        array(
            'regular_id' => 348,
            'name' => 'Կապանի ԲԿ ՓԲԸ',
            'code' => '72033',
            'status' => 'active',
        ),
        348 =>
        array(
            'regular_id' => 349,
            'name' => 'Սյունիքի մարզայ ին նյարդահոգեբուժ. Դիսպանսեր ՓԲԸ',
            'code' => '72122',
            'status' => 'active',
        ),
        349 =>
        array(
            'regular_id' => 350,
            'name' => 'Նորաշենիկի ԱԱՊԿ ՓԲԸ',
            'code' => '72253',
            'status' => 'active',
        ),
        350 =>
        array(
            'regular_id' => 351,
            'name' => 'Մեղրու տարածաշրջանային ԲԿ ՓԲԸ',
            'code' => '79033',
            'status' => 'active',
        ),
        351 =>
        array(
            'regular_id' => 352,
            'name' => 'Սիսիանի ԲԿ ՓԲԸ',
            'code' => '88033',
            'status' => 'active',
        ),
        352 =>
        array(
            'regular_id' => 353,
            'name' => 'Անգեղակոթի ԲԱ ՓԲԸ',
            'code' => '88250',
            'status' => 'active',
        ),
        353 =>
        array(
            'regular_id' => 354,
            'name' => 'Բռնակոթի ԱԱՊԿ ՓԲԸ',
            'code' => '88251',
            'status' => 'active',
        ),
        354 =>
        array(
            'regular_id' => 355,
            'name' => 'Դարբասի ԲԱ ՓԲԸ',
            'code' => '88253',
            'status' => 'active',
        ),
        355 =>
        array(
            'regular_id' => 356,
            'name' => 'Գորայքի ԱԱՊԿ ՓԲԸ',
            'code' => '88254',
            'status' => 'active',
        ),
        356 =>
        array(
            'regular_id' => 357,
            'name' => 'Ջերմուկի ԱԿ ՓԲԸ',
            'code' => '20031',
            'status' => 'active',
        ),
        357 =>
        array(
            'regular_id' => 358,
            'name' => 'Վայքի ԲՄ ՓԲԸ',
            'code' => '44032',
            'status' => 'active',
        ),
        358 =>
        array(
            'regular_id' => 359,
            'name' => 'Զառիթափ ԱԱՊԿ ՓԲԸ',
            'code' => '44250',
            'status' => 'active',
        ),
        359 =>
        array(
            'regular_id' => 360,
            'name' => 'Եղեգնաձորի ԲԿ ՊՓԲԸ',
            'code' => '65032',
            'status' => 'active',
        ),
        360 =>
        array(
            'regular_id' => 361,
            'name' => 'Մալիշկա ԱԱՊԿ ՓԲԸ',
            'code' => '65250',
            'status' => 'active',
        ),
        361 =>
        array(
            'regular_id' => 362,
            'name' => '"Հռիփսիմե" ԲԱ ՓԲԸ',
            'code' => '65253',
            'status' => 'active',
        ),
        362 =>
        array(
            'regular_id' => 363,
            'name' => 'Աղավնաձորի ԱԱՊԿ ՓԲԸ',
            'code' => '65254',
            'status' => 'active',
        ),
        363 =>
        array(
            'regular_id' => 364,
            'name' => 'Արենիի ԱԱՊԿ ՓԲԸ',
            'code' => '65255',
            'status' => 'active',
        ),
        364 =>
        array(
            'regular_id' => 365,
            'name' => 'Դիլիջանի ԲԿ ՓԲԸ',
            'code' => '21031',
            'status' => 'active',
        ),
        365 =>
        array(
            'regular_id' => 366,
            'name' => 'Հաղարծնի ԱԱՊԿ ՓԲԸ',
            'code' => '21250',
            'status' => 'active',
        ),
        366 =>
        array(
            'regular_id' => 367,
            'name' => 'Իջևանի ԲԿ ՓԲԸ',
            'code' => '67032',
            'status' => 'active',
        ),
        367 =>
        array(
            'regular_id' => 368,
            'name' => 'Աչաջրի ԱԿ ՓԲԸ',
            'code' => '67066',
            'status' => 'active',
        ),
        368 =>
        array(
            'regular_id' => 369,
            'name' => 'Իջևանի ԱԱՊԿ ՓԲԸ',
            'code' => '67186',
            'status' => 'active',
        ),
        369 =>
        array(
            'regular_id' => 370,
            'name' => 'Գանձաքարի ԲԱ ՓԲԸ',
            'code' => '67252',
            'status' => 'active',
        ),
        370 =>
        array(
            'regular_id' => 371,
            'name' => 'Խաշթառակի ԱԱՊԿ ՓԲԸ',
            'code' => '67254',
            'status' => 'active',
        ),
        371 =>
        array(
            'regular_id' => 372,
            'name' => 'Սևքարի ԲԱ ՓԲԸ',
            'code' => '67255',
            'status' => 'active',
        ),
        372 =>
        array(
            'regular_id' => 373,
            'name' => 'Այգեհովիտի ԱԱՊԿ ՓԲԸ',
            'code' => '67256',
            'status' => 'active',
        ),
        373 =>
        array(
            'regular_id' => 374,
            'name' => 'Ազատամուտի ԱԱՊԿ ՓԲԸ',
            'code' => '67257',
            'status' => 'active',
        ),
        374 =>
        array(
            'regular_id' => 375,
            'name' => 'Գետահովիտի ԱԱՊԿ ՓԲԸ',
            'code' => '67258',
            'status' => 'active',
        ),
        375 =>
        array(
            'regular_id' => 376,
            'name' => 'Նոյեմբերյանի ԲԿ ՓԲԸ',
            'code' => '81032',
            'status' => 'active',
        ),
        376 =>
        array(
            'regular_id' => 377,
            'name' => 'Կողբի ԲԱ ՓԲԸ',
            'code' => '81250',
            'status' => 'active',
        ),
        377 =>
        array(
            'regular_id' => 378,
            'name' => 'Բերդավանի ԲԱ ՓԲԸ',
            'code' => '81251',
            'status' => 'active',
        ),
        378 =>
        array(
            'regular_id' => 379,
            'name' => 'Կոթիի ԲԱ ՓԲԸ',
            'code' => '81252',
            'status' => 'active',
        ),
        379 =>
        array(
            'regular_id' => 380,
            'name' => 'Ոսկևանի ԲԱ ՓԲԸ',
            'code' => '81253',
            'status' => 'active',
        ),
        380 =>
        array(
            'regular_id' => 381,
            'name' => 'Զորականի ԲԱ ՓԲԸ',
            'code' => '81254',
            'status' => 'active',
        ),
        381 =>
        array(
            'regular_id' => 382,
            'name' => 'Այրումի ԲԱ ՓԲԸ',
            'code' => '81255',
            'status' => 'active',
        ),
        382 =>
        array(
            'regular_id' => 383,
            'name' => 'Բագրատաշենի ԲԱ ՓԲԸ',
            'code' => '81256',
            'status' => 'active',
        ),
        383 =>
        array(
            'regular_id' => 384,
            'name' => 'Բերդի ԲԿ ՓԲԸ',
            'code' => '97032',
            'status' => 'active',
        ),
        384 =>
        array(
            'regular_id' => 385,
            'name' => 'Արծվաբերդի ԱԿ ՓԲԸ',
            'code' => '97065',
            'status' => 'active',
        ),
        385 =>
        array(
            'regular_id' => 386,
            'name' => 'Պառավաքարի ԲԱ ՓԲԸ',
            'code' => '97252',
            'status' => 'active',
        ),
        386 =>
        array(
            'regular_id' => 387,
            'name' => 'Այգեձորի ԱԿ ՓԲԸ',
            'code' => '97253',
            'status' => 'active',
        ),
        387 =>
        array(
            'regular_id' => 388,
            'name' => 'Մոսեսգեղի ԱԱՊԿ ՓԲԸ',
            'code' => '97254',
            'status' => 'active',
        ),
        388 =>
        array(
            'regular_id' => 389,
            'name' => 'Ներքին Կարմիր Աղբյուրի ԱԱՊԿ ՓԲԸ',
            'code' => '97255',
            'status' => 'active',
        ),
        389 =>
        array(
            'regular_id' => 390,
            'name' => 'Նավուրի ԱԱՊԿ ՓԲԸ',
            'code' => '97256',
            'status' => 'active',
        ),
        390 =>
        array(
            'regular_id' => 391,
            'name' => 'Սուրբ Գրիգոր Լուսավորիչ բժշկական կենտրոն ՓԲԸ',
            'code' => '40040',
            'status' => 'active',
        ),
        391 =>
        array(
            'regular_id' => 392,
            'name' => '\'\' Արմենիա\'\' հանրապետական ԲԿ ՓԲԸ',
            'code' => '40020',
            'status' => 'active',
        ),
        392 =>
        array(
            'regular_id' => 393,
            'name' => '"ՈՒռոլոգիայի կենտրոն " ՓԲԸ',
            'code' => '40028',
            'status' => 'active',
        ),
        393 =>
        array(
            'regular_id' => 394,
            'name' => '"Մ. Հերացու անվան համալսարանական ԲԿ" ՊՈԱԿ',
            'code' => '40032',
            'status' => 'active',
        ),
        394 =>
        array(
            'regular_id' => 395,
            'name' => '"Նաիրի\'\' ԲԿ ՓԲԸ',
            'code' => '40041',
            'status' => 'active',
        ),
        395 =>
        array(
            'regular_id' => 396,
            'name' => '"ԱրթՄեդ" բժշկական վերականգնող. կենտրոն ՓԲԸ',
            'code' => '40042',
            'status' => 'active',
        ),
        396 =>
        array(
            'regular_id' => 397,
            'name' => '\'\'Արմենիկում" ՓԲԸ',
            'code' => '40043',
            'status' => 'active',
        ),
        397 =>
        array(
            'regular_id' => 398,
            'name' => '"Քանկոր" սիրտ-անոթային Բկ',
            'code' => '40045',
            'status' => 'active',
        ),
        398 =>
        array(
            'regular_id' => 399,
            'name' => '\'\'Էլեն-Նարե\'\' ծննդօգնության կենտրոն ՍՊԸ',
            'code' => '40050',
            'status' => 'active',
        ),
        399 =>
        array(
            'regular_id' => 400,
            'name' => '\'\'Օքսիժեն մեդ \'\' ՍՊԸ',
            'code' => '40051',
            'status' => 'active',
        ),
        400 =>
        array(
            'regular_id' => 401,
            'name' => '"Ֆենիքս-Մեդ" ՍՊԸ',
            'code' => '40052',
            'status' => 'active',
        ),
        401 =>
        array(
            'regular_id' => 402,
            'name' => '"Մեդբալանս" ՍՊԸ',
            'code' => '40053',
            'status' => 'active',
        ),
        402 =>
        array(
            'regular_id' => 403,
            'name' => '"Մալետտի " բժշկական կենտրոն ՍՊԸ',
            'code' => '40054',
            'status' => 'active',
        ),
        403 =>
        array(
            'regular_id' => 404,
            'name' => '"Դիագեն պլյուս" ՍՊԸ',
            'code' => '40055',
            'status' => 'active',
        ),
        404 =>
        array(
            'regular_id' => 405,
            'name' => '\'Մեփլ Լիֆս" Հայ-Կանադ. Համատ.Ձ/Կ ԲԿ ՍՊԸ',
            'code' => '40056',
            'status' => 'active',
        ),
        405 =>
        array(
            'regular_id' => 406,
            'name' => '"Մուրացան" համալսարանական հիվանդանոց',
            'code' => '40057',
            'status' => 'active',
        ),
        406 =>
        array(
            'regular_id' => 407,
            'name' => '"Ավանգարդ Մեդ" ՍՊԸ',
            'code' => '40058',
            'status' => 'active',
        ),
        407 =>
        array(
            'regular_id' => 408,
            'name' => 'Պլաստիկ վիրաբուժական և Էստետիկ բժշկական կենտրոն',
            'code' => '40059',
            'status' => 'active',
        ),
        408 =>
        array(
            'regular_id' => 409,
            'name' => '"Վիտրոմեդ ՎԱԿ"ՍՊԸ',
            'code' => '40060',
            'status' => 'active',
        ),
        409 =>
        array(
            'regular_id' => 410,
            'name' => '"ՍԵՎԼ Իսրայելյաններ" ՍՊԸ',
            'code' => '40062',
            'status' => 'active',
        ),
        410 =>
        array(
            'regular_id' => 411,
            'name' => '\'\' Բարեկամ\'\' ՍՊԸ',
            'code' => '40063',
            'status' => 'active',
        ),
        411 =>
        array(
            'regular_id' => 412,
            'name' => '\'\'Իզմիրլյան\'\' ԲԿ',
            'code' => '40070',
            'status' => 'active',
        ),
        412 =>
        array(
            'regular_id' => 413,
            'name' => '"Արտեմիսիա" ՍՊԸ',
            'code' => '40071',
            'status' => 'active',
        ),
        413 =>
        array(
            'regular_id' => 414,
            'name' => '"Արմինե Գրիգորյան" ԱՁ',
            'code' => '40072',
            'status' => 'active',
        ),
        414 =>
        array(
            'regular_id' => 415,
            'name' => '\'\' Առիգ - մեդ \'\' ՍՊԸ',
            'code' => '40073',
            'status' => 'active',
        ),
        415 =>
        array(
            'regular_id' => 416,
            'name' => '\'\' Մեդեսի \'\' ՍՊԸ',
            'code' => '40074',
            'status' => 'active',
        ),
        416 =>
        array(
            'regular_id' => 417,
            'name' => '\'\'Նորք\'\' ինֆ. հիվ. ՓԲԸ',
            'code' => '40090',
            'status' => 'active',
        ),
        417 =>
        array(
            'regular_id' => 418,
            'name' => 'Նուբարաշենի հոգեբուժ. բժշկական կենտրոն ՓԲԸ',
            'code' => '40098',
            'status' => 'active',
        ),
        418 =>
        array(
            'regular_id' => 419,
            'name' => 'Հանր. անձավաբուժական կենտրոն ՓԲԸ',
            'code' => '40099',
            'status' => 'active',
        ),
        419 =>
        array(
            'regular_id' => 420,
            'name' => '"Ս.Վ. Մալայանի անվան ակնաբուժական կենտրոն" ՓԲԸ',
            'code' => '40100',
            'status' => 'active',
        ),
        420 =>
        array(
            'regular_id' => 421,
            'name' => 'Մաշկաբանության և ՍՃՓ հիվանդությունների ԲԿ ՓԲԸ',
            'code' => '40111',
            'status' => 'active',
        ),
        421 =>
        array(
            'regular_id' => 422,
            'name' => 'Հանր. հոգեկան առողջ. կենտրոն \'\'Նորք\'\' ՓԲԸ',
            'code' => '40113',
            'status' => 'active',
        ),
        422 =>
        array(
            'regular_id' => 423,
            'name' => 'Հանրապետական նարկոլոգիական կենտրոն ՓԲԸ',
            'code' => '40115',
            'status' => 'active',
        ),
        423 =>
        array(
            'regular_id' => 424,
            'name' => '"Դիագնոստիկա" ԲՄ ԲԲԸ',
            'code' => '40118',
            'status' => 'active',
        ),
        424 =>
        array(
            'regular_id' => 425,
            'name' => 'ՀԲԿ ՓԲԸ Ավանի հոգեբուժական կլինիկա ՓԲԸ',
            'code' => '40122',
            'status' => 'active',
        ),
        425 =>
        array(
            'regular_id' => 426,
            'name' => 'ՁԻԱՀ-ի կանխանգ,հանր,կենտրոն ՊՈԱԿ',
            'code' => '40127',
            'status' => 'active',
        ),
        426 =>
        array(
            'regular_id' => 427,
            'name' => '"Հանրապետական մանկական վերականգնող. կենտրոն" ՓԲԸ',
            'code' => '40129',
            'status' => 'active',
        ),
        427 =>
        array(
            'regular_id' => 428,
            'name' => '\'\'Արաբկիր երեխ. և դեռահաս. Առողջ. Ինստիտուտ" ՍՊԸ',
            'code' => '40131',
            'status' => 'active',
        ),
        428 =>
        array(
            'regular_id' => 429,
            'name' => '" Ավիաբուժ" ԲԿ ՓԲԸ',
            'code' => '40143',
            'status' => 'active',
        ),
        429 =>
        array(
            'regular_id' => 430,
            'name' => '\'\'Գրացիա վերականգ. Կենտ " ՍՊԸ',
            'code' => '40151',
            'status' => 'active',
        ),
        430 =>
        array(
            'regular_id' => 431,
            'name' => '"Վ.Ավագյանի անվան" ԲԿ ՍՊԸ',
            'code' => '40153',
            'status' => 'active',
        ),
        431 =>
        array(
            'regular_id' => 432,
            'name' => 'Հատուկ պոլիկլինիկա ՓԲԸ',
            'code' => '40154',
            'status' => 'active',
        ),
        432 =>
        array(
            'regular_id' => 433,
            'name' => '"Կոսմետոլոգիայի և պլաստիկ վիրաբուժ. կենտրոն" ՓԲԸ',
            'code' => '40156',
            'status' => 'active',
        ),
        433 =>
        array(
            'regular_id' => 434,
            'name' => '\'\'Արմենիա\'\' ՀԲԿ պոլիկլինիկա 6պոլ. ՓԲԸ',
            'code' => '40160',
            'status' => 'active',
        ),
        434 =>
        array(
            'regular_id' => 435,
            'name' => '\'\'Մեդլայն Կլինիկ\'\' ՍՊԸ',
            'code' => '40215',
            'status' => 'active',
        ),
        435 =>
        array(
            'regular_id' => 436,
            'name' => '\'\'Գարանտ Ասիստանս\'\' ՍՊԸ',
            'code' => '40216',
            'status' => 'active',
        ),
        436 =>
        array(
            'regular_id' => 437,
            'name' => '՛՛Ժամանակակից վիրաբուժ. կլինիկա՛՛ ՍՊԸ',
            'code' => '40217',
            'status' => 'active',
        ),
        437 =>
        array(
            'regular_id' => 438,
            'name' => '"Մեդէքսսպրես" ԲԿԱ ՍՊԸ',
            'code' => '40218',
            'status' => 'active',
        ),
        438 =>
        array(
            'regular_id' => 439,
            'name' => '\'\'ԱՎԱ ՄԵԴ\'\' ՍՊԸ',
            'code' => '40219',
            'status' => 'active',
        ),
        439 =>
        array(
            'regular_id' => 440,
            'name' => '\'\' Լյուդվիգովիչ\'\' ՍՊԸ',
            'code' => '40221',
            'status' => 'active',
        ),
        440 =>
        array(
            'regular_id' => 441,
            'name' => '\'\'Էլիտ- Մեդ ԲԿ\'\' ՍՊԸ',
            'code' => '40222',
            'status' => 'active',
        ),
        441 =>
        array(
            'regular_id' => 442,
            'name' => '\'\'Բժշկ. Գենետիկայի կենտրոն\'\' ՍՊԸ',
            'code' => '40225',
            'status' => 'active',
        ),
        442 =>
        array(
            'regular_id' => 443,
            'name' => 'Իմմա ՍՊԸ',
            'code' => '40226',
            'status' => 'active',
        ),
        443 =>
        array(
            'regular_id' => 444,
            'name' => '"Ռ. և Պ. ՍԿԷՆԱՌ " առողջ. վերականգ կենտրոն ՍՊԸ',
            'code' => '40240',
            'status' => 'active',
        ),
        444 =>
        array(
            'regular_id' => 445,
            'name' => '\'\'Նվեր-Անի " ՍՊԸ',
            'code' => '40242',
            'status' => 'active',
        ),
        445 =>
        array(
            'regular_id' => 446,
            'name' => '\'\'Գապէքս" ՍՊԸ',
            'code' => '40243',
            'status' => 'active',
        ),
        446 =>
        array(
            'regular_id' => 447,
            'name' => '" Լուսածին" ակն. վիրաբ. կլինիկա ՍՊԸ',
            'code' => '40245',
            'status' => 'active',
        ),
        447 =>
        array(
            'regular_id' => 448,
            'name' => '\'\'Մեդլայն" ՍՊԸ',
            'code' => '40246',
            'status' => 'active',
        ),
        448 =>
        array(
            'regular_id' => 449,
            'name' => '\'\'Պրոմեթեյ" ԲԿ ՍՊԸ',
            'code' => '40247',
            'status' => 'active',
        ),
        449 =>
        array(
            'regular_id' => 450,
            'name' => '"Հայ-Ամերիկյան ԱԿ" հիմնադրամ',
            'code' => '40248',
            'status' => 'active',
        ),
        450 =>
        array(
            'regular_id' => 451,
            'name' => '"Հ.Կարագյոզյան" բժշկ. Հասար. Բարեգործ. Կազմ.',
            'code' => '40249',
            'status' => 'active',
        ),
        451 =>
        array(
            'regular_id' => 452,
            'name' => '\'\'Ապոլլոն" ՍՊԸ',
            'code' => '40250',
            'status' => 'active',
        ),
        452 =>
        array(
            'regular_id' => 453,
            'name' => '\'\'Նորմեդ" ՍՊԸ',
            'code' => '40251',
            'status' => 'active',
        ),
        453 =>
        array(
            'regular_id' => 454,
            'name' => '\'\'Ինտերդիագնոստիկա \'\' ՍՊԸ',
            'code' => '40252',
            'status' => 'active',
        ),
        454 =>
        array(
            'regular_id' => 455,
            'name' => '"Սպեղանի-Գրական \'\' ՍՊԸ',
            'code' => '40253',
            'status' => 'active',
        ),
        455 =>
        array(
            'regular_id' => 456,
            'name' => '" Իգնացիա\'\' ՍՊԸ',
            'code' => '40254',
            'status' => 'active',
        ),
        456 =>
        array(
            'regular_id' => 457,
            'name' => '"Գրանդ Քենդի" ՀՁ ՍՊԸ',
            'code' => '40255',
            'status' => 'active',
        ),
        457 =>
        array(
            'regular_id' => 458,
            'name' => '"Մեղրիկյան կենտրոն"',
            'code' => '40256',
            'status' => 'active',
        ),
        458 =>
        array(
            'regular_id' => 459,
            'name' => '"Ամիդա \'\' ՍՊԸ',
            'code' => '40257',
            'status' => 'active',
        ),
        459 =>
        array(
            'regular_id' => 460,
            'name' => '\'\'Օն կլինիկ-Անի\'\' ՍՊԸ',
            'code' => '40258',
            'status' => 'active',
        ),
        460 =>
        array(
            'regular_id' => 461,
            'name' => '"Աղաբեկյան\'\' ախտորոշիչ կլինիկա ՍՊԸ',
            'code' => '40302',
            'status' => 'active',
        ),
        461 =>
        array(
            'regular_id' => 462,
            'name' => '\'\'Վիոլա" ՍՊԸ',
            'code' => '40304',
            'status' => 'active',
        ),
        462 =>
        array(
            'regular_id' => 463,
            'name' => '"Վարդանանց\'\' ՍՊԸ',
            'code' => '40305',
            'status' => 'active',
        ),
        463 =>
        array(
            'regular_id' => 464,
            'name' => '"Գալաթեա-մեդ" ՍՊԸ',
            'code' => '40306',
            'status' => 'active',
        ),
        464 =>
        array(
            'regular_id' => 465,
            'name' => '"Սեքսո-Պաթ.վեր.քաղ.կենտրոն ՍՊԸ',
            'code' => '40309',
            'status' => 'active',
        ),
        465 =>
        array(
            'regular_id' => 466,
            'name' => '\'\'Մեդ Էլեն\'\' ՍՊԸ',
            'code' => '40311',
            'status' => 'active',
        ),
        466 =>
        array(
            'regular_id' => 467,
            'name' => '"Դիալաբ" ՍՊԸ',
            'code' => '40313',
            'status' => 'active',
        ),
        467 =>
        array(
            'regular_id' => 468,
            'name' => '"Հորմոն" ՍՊԸ',
            'code' => '40314',
            'status' => 'active',
        ),
        468 =>
        array(
            'regular_id' => 469,
            'name' => '"Ուլտրամեդ" ՍՊԸ',
            'code' => '40315',
            'status' => 'active',
        ),
        469 =>
        array(
            'regular_id' => 470,
            'name' => '"Օմեգա" ՍՊԸ',
            'code' => '40316',
            'status' => 'active',
        ),
        470 =>
        array(
            'regular_id' => 471,
            'name' => '"Ուլտրալաբ" ՍՊԸ',
            'code' => '40318',
            'status' => 'active',
        ),
        471 =>
        array(
            'regular_id' => 472,
            'name' => '"Ցիտո-Լաբ" բժշկական կենտրոն ՍՊԸ',
            'code' => '40319',
            'status' => 'active',
        ),
        472 =>
        array(
            'regular_id' => 473,
            'name' => '\'\'Վիկմեդ\'\' էսթետիկ բժշկական կենտրոն ՍՊԸ',
            'code' => '40320',
            'status' => 'active',
        ),
        473 =>
        array(
            'regular_id' => 474,
            'name' => '"Անտարես" ՍՊԸ',
            'code' => '40321',
            'status' => 'active',
        ),
        474 =>
        array(
            'regular_id' => 475,
            'name' => '"Դիասթար" ՍՊԸ',
            'code' => '40323',
            'status' => 'active',
        ),
        475 =>
        array(
            'regular_id' => 476,
            'name' => '"Տարերք-Թվայն" բժշկական կենտրոն ՍՊԸ',
            'code' => '40401',
            'status' => 'active',
        ),
        476 =>
        array(
            'regular_id' => 477,
            'name' => '"Նվարդ Մեդիա" բժշկական կենտրոն ՍՊԸ',
            'code' => '40402',
            'status' => 'active',
        ),
        477 =>
        array(
            'regular_id' => 478,
            'name' => '"Արմամաքս " բժշկական կենտրոն ՍՊԸ',
            'code' => '40403',
            'status' => 'active',
        ),
        478 =>
        array(
            'regular_id' => 479,
            'name' => '"Ֆրանսիա-Փարիզ բժշկական Հայկական միությոին"',
            'code' => '40412',
            'status' => 'active',
        ),
        479 =>
        array(
            'regular_id' => 480,
            'name' => '\'\'Սլավ Մեդ \'\' ԲԿ ՍՊԸ',
            'code' => '40422',
            'status' => 'active',
        ),
        480 =>
        array(
            'regular_id' => 481,
            'name' => '"Նորքի տուն ինտերնատի" ամբուլատորիա ՊՈԱԿ',
            'code' => '40770',
            'status' => 'active',
        ),
        481 =>
        array(
            'regular_id' => 482,
            'name' => '"Վերարտադրողական առողջության կենտրոն" ՀԻ ՓԲԸ',
            'code' => '40779',
            'status' => 'active',
        ),
        482 =>
        array(
            'regular_id' => 483,
            'name' => 'ՀՀ ԱՆ "Դատաբժշկական ԳԳԿ" ՊՈԱԿ',
            'code' => '40840',
            'status' => 'active',
        ),
        483 =>
        array(
            'regular_id' => 484,
            'name' => '"Սուրբ Թերեզա" ՍՊԸ',
            'code' => '40948',
            'status' => 'active',
        ),
        484 =>
        array(
            'regular_id' => 485,
            'name' => '"Մոր և մանկան առողջ.պահպ. ԳՀ կենտրոն" ՓԲԸ',
            'code' => '40955',
            'status' => 'active',
        ),
        485 =>
        array(
            'regular_id' => 486,
            'name' => 'Կուրորտաբանության և ֆիզիկական բժշկ. ԳՀԻ ՓԲԸ',
            'code' => '40956',
            'status' => 'active',
        ),
        486 =>
        array(
            'regular_id' => 487,
            'name' => 'Պրոֆ. Լ.Օ.Յոլյանի անվ. հանր.արյուն կենտր. ՓԲԸ',
            'code' => '40957',
            'status' => 'active',
        ),
        487 =>
        array(
            'regular_id' => 488,
            'name' => 'Վնասվածք. օրթոպեդիայի և վերականգ. կենտրոն ՓԲԸ',
            'code' => '40958',
            'status' => 'active',
        ),
        488 =>
        array(
            'regular_id' => 489,
            'name' => 'Վ.Ա. Ֆանարջյանի անվան ՈՒԳԿ ՓԲԸ',
            'code' => '40961',
            'status' => 'active',
        ),
        489 =>
        array(
            'regular_id' => 490,
            'name' => 'Ճառ. բժշկ. և այրվածք. հանր. գիտ. կենտր ՓԲԸ',
            'code' => '40962',
            'status' => 'active',
        ),
        490 =>
        array(
            'regular_id' => 491,
            'name' => '" Համաճար, վիրուս.և բժշկ. Մակաբ. ԳՀԻ" ՊՈԱԿ',
            'code' => '40963',
            'status' => 'active',
        ),
        491 =>
        array(
            'regular_id' => 492,
            'name' => '" Լ. Ա. Միքայելյան" վիրաբուժության ինստիտուտ ՓԲԸ',
            'code' => '40964',
            'status' => 'active',
        )
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\Clinic::class, 10)->create();
        // foreach($this->clinics as $key => $clinic) {
        //     Clinic::create(['regular_id'=>($key+1), 'name'=>$clinic]);
        // }

        foreach ($this->clinics_array as $key => $clinic) {
            Clinic::create($clinic);
        }
    }
}
