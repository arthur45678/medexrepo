<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanningProtocolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planning_protocols', function (Blueprint $table) {
            $table->id();
            $table->timestamp('parent_date')->comment('Կենսանյութը վերցնելու ամսաթիվ');
            $table->timestamp('date_treatment')->nullable()->comment('Բուժման նախատեսվող սկիզբ');

            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('specialist')->nullable()->comment('Ուղեգրող բժիշկ');



//         Բուժասարք

            $table->longText('medical_device')->nullable()->comment('Բուժասարք');
            $table->enum('device',['Terabalt','Elekta'])->nullable()->comment('Բուժասարք');
//            Portal imaging
            $table->longText('portal_imaging')->nullable()->comment('Բուժասարք');
            $table->enum('portal',['yes','no'])->nullable()->comment(' Portal imaging');
//            CT / MRI fusion
            $table->longText('MRI_fusion')->nullable()->comment('CT / MRI fusion');
            $table->enum('fusion',['yes','no'])->nullable()->comment('CT / MRI fusion');
 //        course_info
            $table->longText('course_info')->nullable()->comment('course_info');
            $table->enum('course',['radical','adjuvant','palliative'])->nullable()->comment('արմատական,ադյուվանտ,պալիատիվ');
//         Բաժնևորում
            $table->longText('section_info')->nullable()->comment('course_info');
            $table->enum('section',['standard','multiplay','escalation'])->nullable()->comment('ստանդարտ ,մուլտ. ,էսկալացիոն');

            $table->longText('MOD_info')->nullable()->comment('ՄՕԴ (Գր)');
            $table->longText('GOD_info')->nullable()->comment('ԳՕԴ (Գր)');
//         Boost
            $table->longText('boost_info')->nullable()->comment('course_info');
            $table->enum('boost',['yes','no','together','sequentially'])->nullable()->comment('այո,ոչ,միաժամանակ,հերթականությամբ');


            $table->longText('risk_organs')->nullable()->comment('Ռիսկի օրգաններ');
            $table->longText('special_notes')->nullable()->comment('Հատուկ նշումներ');
            $table->unsignedBigInteger('performing_physicist')->nullable()->comment('Կատարող ֆիզիկոս');
            $table->unsignedBigInteger('healer_doctor')->nullable()->comment('Բուժող բժիշկ');
//            ՀՇ ՊԼԱՆԱՎՈՐՄԱՆ-ԱՐՁԱՆԱԳՐՈՒԹՅՈՒՆ
//            Լրացնում է ճառագայթային ուռուցքաբանը
            $table->timestamp('date')->nullable()->comment('Կենսանյութը վերցնելու ամսաթիվ');
            $table->longText('section_step')->nullable()->comment('Հետազոտվող հատվածը և քայլը (մմ)');
//            Հիվանդի դիրքը
            $table->longText('patient_position')->nullable()->comment('course_info');
            $table->enum('position',['Supine','Prone'])->nullable()->comment('Մեջքին(Supine)Փորին(Prone)');
//      Կոնտրաստ

            $table->longText('contrast_info')->nullable()->comment('course_info');
            $table->enum('contrast',['without','n_e','per_os','per_rectum'])->nullable()->comment('Մեջքին(Supine)Փորին(Prone)');

//            Լրացնում է ճառագայթային տեխնիկը
            $table->longText('breast')->nullable()->comment('Breast board №1');
//            N1 (Med-Tec)
            $table->longText('n1_height')->nullable()->comment('Բարձրություն');
            $table->longText('n1_headache')->nullable()->comment('Գլխատակ');
            $table->longText('n1_hands')->nullable()->comment('Ձեռքեր');

            $table->enum('n1_hand',['right','left'])->nullable()->comment('աջ,ձախ');
//            N2(Q-flx)
            $table->longText('corner')->nullable()->comment('Անկյուն');
            $table->enum('n2_hand',['right','left'])->nullable()->comment('աջ,ձախ');

            $table->longText('n2_headache_info')->nullable()->comment('Ձեռքեր comments');
            $table->longText('arched_position')->nullable()->comment('Կամար դիրքը');
            $table->longText('n2_height')->nullable()->comment('Բարձրություն');
            $table->longText('n2_special_notes')->nullable()->comment('Հատուկ նշումներ');
            $table->enum('n2_headache',['a','b','c','d','e','f'])->nullable()->comment('Գլխատակ');
            $table->longText('belly_board')->nullable()->comment('Belly board');

            $table->enum('board',['Knee','Foot'])->nullable()->comment('Ծունկ Ոտնաթաթ ');
            $table->longText('board_info')->nullable()->comment('Belly board');

//            Դիմակ
            $table->enum('mask',['yes','no'])->nullable()->comment('Դիմակ yes no');
            $table->longText('mask_info')->nullable()->comment('Դիմակ');
//            Նշումներ
            $table->enum('notes',['tatoo','draw'])->nullable()->comment('Նշումներ');
            $table->longText('notes_info')->nullable()->comment('Նշումներ');
//            Սպիի նշումներ
            $table->enum('scar_notes',['yes','no'])->nullable()->comment('Սպիի Նշումներ');
            $table->longText('scar_notes_info')->nullable()->comment('Սպիի նշումներ');

//           Կրծքագեղձի նշում
            $table->enum('breast_notes',['yes','no'])->nullable()->comment('Կրծքագեղձի նշում');
            $table->longText('breast_notes_info')->nullable()->comment('Կրծքագեղձի նշում');
//            Կատարող
            $table->unsignedBigInteger('performer')->nullable()->comment('Կատարող');
            $table->unsignedBigInteger('n2_healer_doctor')->nullable()->comment('Բուժող բժիշկ');

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('performing_physicist')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('healer_doctor')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('performer')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('n2_healer_doctor')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('planning_protocols');
    }
}
