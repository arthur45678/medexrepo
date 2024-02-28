<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNamesMaterialValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('names_material_values', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Անվանումը, բնութագիրը')->nullable();
            $table->string('code')->comment('ծածկագիրը')->nullable();
            $table->string('unit')->nullable()->comment('Չափման միավոր');
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
        Schema::dropIfExists('names_material_values');
    }
}
