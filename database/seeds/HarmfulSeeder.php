<?php

use Illuminate\Database\Seeder;
use App\Models\Harmful;

class HarmfulSeeder extends Seeder
{
    public $harmfuls = array(
        array('id' => '1', 'regular_id' => '1', 'parent_id' => NULL, 'name' => 'Ծխում է'),
        array('id' => '2', 'regular_id' => '2', 'parent_id' => NULL, 'name' => 'Ալկոհոլի օգտագործում'),
        array('id' => '3', 'regular_id' => '3', 'parent_id' => NULL, 'name' => 'Թմրանյութ'),
        array('id' => '4', 'regular_id' => '4', 'parent_id' => NULL, 'name' => 'Վնասակար սննդակարգ'),
        array('id' => '5', 'regular_id' => '5', 'parent_id' => '1', 'name' => 'ամեն օր'),
        array('id' => '6', 'regular_id' => '6', 'parent_id' => '1', 'name' => 'պարբերաբար'),
        array('id' => '7', 'regular_id' => '7', 'parent_id' => '1', 'name' => 'նախկինում'),
        array('id' => '8', 'regular_id' => '8', 'parent_id' => '1', 'name' => 'երբեք'),
        array('id' => '9', 'regular_id' => '9', 'parent_id' => '2', 'name' => 'ամսվա ընթացքում'),
        array('id' => '10', 'regular_id' => '10', 'parent_id' => '2', 'name' => 'շաբաթվա ընթացքում'),
        array('id' => '11', 'regular_id' => '11', 'parent_id' => '2', 'name' => 'օրական'),
        array('id' => '12', 'regular_id' => '12', 'parent_id' => '2', 'name' => 'նախկինում'),
        array('id' => '13', 'regular_id' => '13', 'parent_id' => '2', 'name' => 'երբեք'),
        array('id' => '14', 'regular_id' => '14', 'parent_id' => '3', 'name' => 'վերջին մեկ տարվա ընթացքում'),
        array('id' => '15', 'regular_id' => '15', 'parent_id' => '3', 'name' => 'վերջին մեկ ամսվա ընթացքում'),
        array('id' => '16', 'regular_id' => '16', 'parent_id' => '3', 'name' => 'վերջին մեկ շաբաթվա ընթացքում'),
        array('id' => '17', 'regular_id' => '17', 'parent_id' => '3', 'name' => 'առհասարակ'),
        array('id' => '18', 'regular_id' => '18', 'parent_id' => '3', 'name' => 'նախկինում'),
        array('id' => '19', 'regular_id' => '19', 'parent_id' => '3', 'name' => 'երբեք'),
        array('id' => '20', 'regular_id' => '20', 'parent_id' => '4', 'name' => 'աղի չարաշահում'),
        array('id' => '21', 'regular_id' => '21', 'parent_id' => '4', 'name' => 'շաքարի և քաղցրավենիքի չարաշահում'),
        array('id' => '22', 'regular_id' => '22', 'parent_id' => '4', 'name' => 'ճարպ պարունակող սննդի չարաշահում'),
        array('id' => '23', 'regular_id' => '23', 'parent_id' => '4', 'name' => 'սնվում է տանը (օրական)'),
        array('id' => '24', 'regular_id' => '24', 'parent_id' => '4', 'name' => 'սնվում է դրսում (օրական)')
    );

    public $harmful_list = array(
        array('id' => '1', 'regular_id' => '1', 'name' => 'Ծխում է - ամեն օր'),
        array('id' => '2', 'regular_id' => '2', 'name' => 'Ծխում է - պարբերաբար'),
        array('id' => '3', 'regular_id' => '3', 'name' => 'Ծխում է - նախկինում'),
        array('id' => '4', 'regular_id' => '4', 'name' => 'Ծխում է - երբեք'),

        array('id' => '5', 'regular_id' => '5', 'name' => 'Ալկոհոլի օգտագործում - ամսվա ընթացքում'),
        array('id' => '6', 'regular_id' => '6', 'name' => 'Ալկոհոլի օգտագործում - շաբաթվա ընթացքում'),
        array('id' => '7', 'regular_id' => '7', 'name' => 'Ալկոհոլի օգտագործում - օրական'),
        array('id' => '8', 'regular_id' => '8', 'name' => 'Ալկոհոլի օգտագործում - նախկինում'),
        array('id' => '9', 'regular_id' => '9', 'name' => 'Ալկոհոլի օգտագործում - երբեք'),

        array('id' => '10', 'regular_id' => '10', 'name' => 'Թմրանյութ - վերջին մեկ տարվա ընթացքում'),
        array('id' => '11', 'regular_id' => '11', 'name' => 'Թմրանյութ - վերջին մեկ ամսվա ընթացքում'),
        array('id' => '12', 'regular_id' => '12', 'name' => 'Թմրանյութ - վերջին մեկ շաբաթվա ընթացքում'),
        array('id' => '13', 'regular_id' => '13', 'name' => 'Թմրանյութ - առհասարակ'),
        array('id' => '14', 'regular_id' => '14', 'name' => 'Թմրանյութ - նախկինում'),
        array('id' => '15', 'regular_id' => '15', 'name' => 'Թմրանյութ - երբեք'),

        array('id' => '16', 'regular_id' => '16', 'name' => 'Վնասակար սննդակարգ - աղի չարաշահում'),
        array('id' => '17', 'regular_id' => '17', 'name' => 'Վնասակար սննդակարգ - շաքարի և քաղցրավենիքի չարաշահում'),
        array('id' => '18', 'regular_id' => '18', 'name' => 'Վնասակար սննդակարգ - ճարպ պարունակող սննդի չարաշահում'),
        array('id' => '19', 'regular_id' => '19', 'name' => 'Վնասակար սննդակարգ - սնվում է տանը (օրական)'),
        array('id' => '20', 'regular_id' => '20', 'name' => 'Վնասակար սննդակարգ - սնվում է դրսում (օրական)'),
    );
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->harmful_list as $key => $harm) {
            Harmful::create($harm);
        }
    }
}
