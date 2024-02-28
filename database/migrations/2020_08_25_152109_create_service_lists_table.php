<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_lists', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('code')->index()->nullable()->default(NULL);
            $table->string('name')->nullable()->default(NULL);
            $table->float('price', 10, 2)->nullable()->default(NULL);
            $table->unsignedSmallInteger('department_id')->nullable()->default(NULL);
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_lists');
    }
}
