<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmunologicalExaminationPatternN7STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immunological_examination_pattern_n7_s', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('research');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('ambulator_id')->nullable()->comment('Ամբուլատոր բժշկական քարտի №');
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger("department_id");
            $table->unsignedBigInteger('specialist')->nullable()->comment('Ուղեգրող բժիշկ');
            $table->unsignedBigInteger('attending_doctor')->nullable()->comment('Հետազոտությունը իրականացնող բժիշկ');
            $table->integer('hospital_room_number')->nullable()->comment('Հիվանդասենյակի համարը');
            $table->integer("stationary_id")->nullable()->comment('Հիվանդության պատմագրի №');
            $table->timestamp('date')->comment('Կենսանյութը վերցնելու ամսաթիվ');
//          ՇՃԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ

            $table->longText('AFP')->nullable()->comment('AFP / ալֆա ֆետոպրոտեին/');
            $table->longText('TPSA')->nullable()->comment('TPSA /ընդ.պրոստատ սպեցիֆիկ հակածին');
            $table->longText('FPSA')->nullable()->comment('FPSA / ազատ պրոստատ սպեցիֆիկ հակածին/');
            $table->longText('CEA')->nullable()->comment('CEA / կարցինոէմբրիոնալ հակածին/');
            $table->longText('CA19')->nullable()->comment('CA19-9 / կարբոհիդրատ հակածին 19-9/');
            $table->longText('CA15')->nullable()->comment('CA15-3 / ուռուցքային հակածին 15-3/');
            $table->longText('CA125')->nullable()->comment('CA125 / ուռուցքային հակածին 125/');
            $table->longText('CA72')->nullable()->comment('CA 72-4 / կարբոհիդրատ հակածին 72-4/');
            $table->longText('NSE')->nullable()->comment('NSE / նեյրոսպեցիֆիկ էնոլազա/');
            $table->longText('Cyfra')->nullable()->comment('Cyfra 21-2 / ցիտոկերատինի մասնիկ 21-2/');
            $table->longText('b-hCG')->nullable()->comment('b-hCG / բետա խորիոնիկ հոնադոթրոպին/');
            $table->longText('SCC')->nullable()->comment('SCC / տափակբջջային ուռուցքային հակածին/');
            $table->longText('b-2MG')->nullable()->comment('b-2MG / բետա -2միկրոգլոբուլին/');
            $table->longText('research-was-done')->nullable()->comment('Հետազոտությունը կատարվել է');
            $table->timestamp('date_research')->nullable()->comment('Շճաբանական հետազոտության պատասխանի ամսաթիվ');

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('ambulator_id')->references('id')->on('ambulators')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('specialist')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('attending_doctor')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('immunological_examination_pattern_n7_s');
    }
}
