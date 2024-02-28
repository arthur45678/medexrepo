<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicroscopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microscopies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('attending_doctor_id');

            $table->text('flat')->nullable()->comment('տափակ');
            $table->text('transient')->nullable()->comment('անցողային');
            $table->text('renal')->nullable()->comment('երիկամային');
            $table->text('leukocytes')->nullable()->comment('լեյկոցիտներ');
            $table->text('erythrocytes')->nullable()->comment('էրիտրոցիտներ');
            $table->text('resume')->nullable()->comment('ամփոփոխ');
            $table->text('changed')->nullable()->comment('փոփոխված');
            $table->text('cylinders')->nullable()->comment('ցիլինդրներ');
            $table->text('hyaline')->nullable()->comment('հիալինային');
            $table->text('candle')->nullable()->comment('մոմաձև');
            $table->text('granular')->nullable()->comment('հատիկավոր');
            $table->text('epithelial')->nullable()->comment('էպիթելային');
            $table->text('leukocyte')->nullable()->comment('լեյկոցիտար');
            $table->text('erythrocyte')->nullable()->comment('էրիթրոցիտար');
            $table->text('pigment')->nullable()->comment('պիգմենտային');
            $table->text('mucus')->nullable()->comment('լորձ');
            $table->text('salt')->nullable()->comment('աղ');
            $table->text('bacteria')->nullable()->comment('բակտերիաներ');
             
            $table->date('analisis_date')->nullable()->comment('անալիզի պատասխան - ամսաթիվ');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('microscopies');
    }
}
