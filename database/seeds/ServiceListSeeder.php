<?php

use Illuminate\Database\Seeder;
use App\Models\ServiceList;

class ServiceListSeeder extends Seeder
{

    protected $services = [
        ['code' => 1111, 'name' => 'service 1', 'price' => 3000, 'department_id' => 1],
        ['code' => 2222, 'name' => 'service 2', 'price' => 5000.75, 'department_id' => 1],
        ['code' => 3333, 'name' => 'service 3', 'price' => 7000, 'department_id' => 1],

        ['code' => 4444, 'name' => 'service 4', 'price' => 9000, 'department_id' => 2],
        ['code' => 5555, 'name' => 'service 5', 'price' => 11000.50, 'department_id' => 2],
        ['code' => 6666, 'name' => 'service 6', 'price' => 13000, 'department_id' => 2],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $paidServicesJson = File::get("database/seeds/dumps/paidServices.json");
        $new_json = preg_replace('/[[:cntrl:]]/', '', $paidServicesJson);
        $xlsxData = json_decode($new_json, true, 512, JSON_UNESCAPED_UNICODE);
        $paidServices = $xlsxData["office:document"]["office:body"]["office:spreadsheet"]["table:table"];

        foreach ($paidServices["table:table-row"] as $key => $rowData) {
            // if (!array_key_exists("text:p", $rowData["table:table-cell"][0])) break;
            // var_dump(count($rowData["table:table-cell"]) >= 6);
            if (
                !(count($rowData["table:table-cell"]) >= 6)
            )
                continue;

            $code = $rowData["table:table-cell"][0]["text:p"];
            // $service_type = $rowData["table:table-cell"][1]["text:p"];
            $name = $rowData["table:table-cell"][2]["text:p"];
            if (is_array($name)) {
                // var_dump($name);
                $name = implode(" ", $name["#text"]);
            }
            // $payment_type = $rowData["table:table-cell"][3]["text:p"];
            $price = (int) $rowData["table:table-cell"][4]["text:p"];
            // var_dump(compact("code", "name", "price"));
            // var_dump($name);
            ServiceList::create([
                "code" => $code,
                "name" => $name,
                "price" => $price
            ]);
        }
    }
}
