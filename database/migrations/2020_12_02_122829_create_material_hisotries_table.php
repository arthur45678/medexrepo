<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialHisotriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_hisotries', function (Blueprint $table) {
            $table->id();
            $table->string('DocumentNumber');
            $table->string('Comment');
            $table->string('StorageExpense');
            $table->string('Chief');
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
        Schema::dropIfExists('material_hisotries');
    }
}
