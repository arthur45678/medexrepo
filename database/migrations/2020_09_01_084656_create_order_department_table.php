<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_department', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')
                ->on('orders')->onUpdate('cascade')->onDelete('set null');

            $table->unsignedSmallInteger("department_id")->nullable()->comment("Բաժանմունք");
            $table->foreign('department_id')->references('id')->on('departments');

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
        Schema::dropIfExists('order_department');
    }
}
