<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEchocardiogramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('echocardiograms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');

            $table->date('patient_age')->comment('Տարիք')->nullable();
            $table->date('admission_date')->comment('Ամսաթիվ')->nullable();
            $table->text('diastolic_size_KDR')->comment('ՁՓ դիաստոլիկ չափս (սմ)(КДР)-Նորմա 4,5-5(սմ)')->nullable();
            $table->text('diastolic_size_KCR')->comment('ՁՓ սիստոլիկ չափս (սմ)(КСР)-Նորմա 3-4.5սմ')->nullable();
            $table->text('diastolic_size_KDO')->comment('ՁՓ դիաստոլիկ ծավալ (մլ)(КДО)-Նորմա 55-160մլ')->nullable();
            $table->text('diastolic_size_KCO')->comment('ՁՓ սիստոլիկ ծավալ (մլ)(КСО)-Նորմա 19-85մլ')->nullable();
            $table->text('back_wall')->comment('Հետին պատ (սմ)-Նորմա 0.7-1.1սմ')->nullable();
            $table->text('interventricular_septum')->comment('Միջփորոքային միջնապատ (սմ)-Նորմա 0,7-1.1սմ')->nullable();
            $table->text('extraction_fraction')->comment('Արտամղման ֆրակցիա(%)(EF) (սմ)-Նորմա')->nullable();
            $table->text('AP_diastolic_size')->comment('ԱՓ դիաստոլիկ չափս (սմ) (КДР)-Նորմա ≤3.5(սմ)')->nullable();
            $table->text('AP_wall_norma')->comment('ԱՓ պատ (սմ)-Նորմա ≤0.5')->nullable();
            $table->text('aortic_roo_diameter')->comment('Աորտաի արմատի տրամագիծ (սմ)-Նորմա ≥2.0-3.7(սմ)')->nullable();
            $table->text('left_atrium_diameter')->comment('Ձախ նախասրտի տրամագիծ (սմ)-Նորմա 3.0-4.0(սմ)')->nullable();
            $table->text('small_size_of_the_left_atrium')->comment('Ձախ նախասրտի փոքր չափս (սմ)-Նորմա ≤4.4(սմ)')->nullable();
            $table->text('the_size_of_the_lower_window')->comment('Ստորին սիներակի չափս (սմ)-Նորմա ≤2.1(սմ)')->nullable();
            $table->text('collapse_of_the_lower_eyelid')->comment('Ստորին սիներակի կոլապս (%))-Նորմա ≥50%')->nullable();
            $table->text('decision')->comment('Եզրակացություն')->nullable();

            $table->unsignedBigInteger('attending_doctor_id')->comment('Բուժող բժիշկ')->nullable();
            $table->foreign('attending_doctor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->unsignedBigInteger('nurse_id')->comment('Բուժքույրեր')->nullable();
            $table->foreign('nurse_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('echocardiograms');
    }
}
