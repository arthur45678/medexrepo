<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_lists', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20);
            $table->text('name');
            $table->string("unit")->comment("Չափման միավոր");
            $table->string("warehouse")->comment("Պահեստ");
            $table->unique(["code"]);
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
        Schema::dropIfExists('medicine_lists');
    }
}
