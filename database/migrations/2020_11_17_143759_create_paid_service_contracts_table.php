<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidServiceContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_service_contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger('department_id');
            $table->unsignedBigInteger('director')->nullable()->comment('director');
            $table->timestamp('date')->nullable()->comment('Կենսանյութը վերցնելու ամսաթիվ');
            $table->timestamp('date_start')->nullable()->comment('Սույն պայմանագրով նախատեսված ծառայությունների մատուցումը սկսվում է ամսաթիվ');
            $table->string('date_end')->nullable()->comment('Սույն պայմանագրով նախատեսված ծառայությունների մատուցումը պետք է ավարտվի է ամսաթիվ');
            $table->longText('doctor_refusal')->nullable()->comment('Բժշկական միջամտությունից հրաժարվելու դեպքում');
            $table->longText('doctor_services')->nullable()->comment('Անհրաժեշտ հարբժշկական և ոչ բուժական բնույթի հետևյալ ծառայությունների մատուցումը');
            $table->longText('doctor_intervention')->nullable()->comment('Բժշկական միջամտության ընթացքում');
            $table->longText('doctor_period_following')->nullable()->comment(' Բժշկական միջամտությանը հաջորդող ժամանակահատվածում');
            $table->date('given')->nullable()->comment('Տրված է');
            $table->string('fromWhom')->nullable()->comment('Ում կողմից');
            $table->string('price')->nullable()->comment(' Գումարը');
            $table->string('payment_method')->nullable()->comment('Վճարման կարգը');
            $table->timestamp('operates_until')->nullable()->comment('Սույն պայմանագիրը ուժի մեջ է մտնում ստորագրման պահից և գործում է մինչև');

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('director')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('paid_service_contracts');
    }
}
