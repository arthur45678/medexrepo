<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnesthesiologistPreSurgeryExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anesthesiologist_pre_surgery_examinations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('attending_doctor_id');
            $table->unsignedTinyInteger('anesthesia_id')->nullable();
            $table->date('date')->nullable()->comment('ամսաթիվ');
            $table->text('body_structure')->nullable()->comment('մարմնի կառուցվածքը - ազատ դաշտ');
            $table->text('weight')->nullable()->comment('քաշը - ազատ դաշտ');
            $table->text('complaints')->nullable()->comment('գանգատները - ազատ դաշտ');
//            Գիտակցությունը
            $table->text('consciousness')->nullable()->comment('Գիտակցությունը - ազատ դաշտ');
//            Վիրահատությունների ցանկ

            $table->date('surgery_datetime')->nullable()->comment('ամսաթիվ');
            $table->unsignedBigInteger('surgery_id')->nullable()->default(NULL);
            $table->text('surgeries_comment')->nullable()->default(NULL);
            $table->foreign('surgery_id')->references('id')->on('surgery_lists')->onDelete('restrict')->onUpdate('cascade');

//            վիրահատության տիպը՝
            $table->enum('surgery_type', ['urgent', 'programmed'])->nullable()->comment('վիրահատության տիպը');
//            Մաշկը և տես. լորձաթաղ.՝
            $table->text('the_skin')->nullable()->comment('Մաշկը և տես. լորձաթաղ - ազատ դաշտ');

            $table->text('cardiovascular_system')->nullable()->comment('Սիրտանոթային համակարգ՝ ԱՃ՝ - ազատ դաշտ');
            $table->text('heart_contraction')->nullable()->comment('Սրտի կծկ. հաճախ.՝ զ/ր - ազատ դաշտ');
            $table->text('auscultation')->nullable()->comment('Աուսկուլտացիա - ազատ դաշտ');
            $table->text('veins')->nullable()->comment('էՍԳ՝, երակներ՝ - ազատ դաշտ');
            $table->text('respiratory_system')->nullable()->comment('Շնչական համակարգ՝, շնչ. հաճ.՝ - ազատ դաշտ');
            $table->text('oral')->nullable()->comment('Բերանի խոռոչ - ազատ դաշտ');
            $table->string('mallampati')->nullable()->comment('mallampati');
            $table->text('other_organ_systems')->nullable()->comment('Այլ օրգան համակարգեր - ազատ դաշտ');
            $table->text('laboratory_tests')->nullable()->comment('Լաբորատոր հետազոտություններ` - ազատ դաշտ');
            $table->text('allergic')->nullable()->comment('Ալերգիկ՝ - ազատ դաշտ');
            $table->text('surgical')->nullable()->comment('Վիրաբուժական - ազատ դաշտ');
            $table->string('ASA')->nullable()->comment('ASA');
            $table->text('special_notes')->nullable()->comment('Հատուկ նշումներ՝ - ազատ դաշտ');
            $table->text('patient_guardian_relative')->nullable()->comment('Հիվանդ/խնամակալ/ ազգական՝');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('attending_doctor_id', 'ad_id_foreign')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign("anesthesia_id")->references("id")->on("anesthesia_lists");

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
        Schema::dropIfExists('anesthesiologist_pre_surgery_examinations');
    }
}
