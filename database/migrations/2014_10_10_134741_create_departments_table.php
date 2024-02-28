<?php
# original name
# 2020_06_18_134741_create_departments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->smallIncrements("id");
            $table->string("name");
            $table->string("code")->nullable()->comment('Հծ-ից եկացած id');
            $table->boolean("has_bads");
            $table->boolean("closed_from_inside")->default(false)->comment('ցանկացած փաստաթուղթ դուրս գալիս պետք է հաստատվի վարիչի կողմից');
            $table->boolean("closed_from_outside")->default(false)->comment('վարիչը տեսնում է բաժնի բաշխված և չբաշխված հիվանդներին');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
