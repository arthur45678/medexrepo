<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationaries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("patient_id");

            $table->unsignedSmallInteger("number")->comment("Հերթական համար");

            $table->unsignedTinyInteger("age")->nullable()->default(NULL);
            $table->enum("age_type", ["year", "month", "day"])->comment("Նշված տարիքի չափման միավոր")->nullable()->default(NULL);

            $table->float("weight", 5, 2, true)->nullable()->default(NULL);
            $table->float("height", 5, 2, true)->nullable()->default(NULL);

            $table->boolean("by_wheelchair")->nullable()->default(FALSE)->comment("Տեղափոխման եղանակ՝ կարող է քայլել, հիվանդասայլակով");

            $table->timestamp("admission_date")->nullable()->default(NULL)->comment("Ընդունման ամսաթիվը և ժամանակը");
            $table->timestamp("discharge_date")->nullable()->default(NULL)->comment("Դուրս գրման ամսաթիվը և ժամանակը");
            $table->string("stage")->nullable()->default(NULL)->comment("Փուլ");
            // $table->string("tnm")->nullable()->default(NULL)->comment("T N M");

            $table->string("T")->nullable()->default(NULL)->comment("TNM - ի T, in:0,1,2,3,4 each with a|b");
            $table->string("N")->nullable()->default(NULL)->comment("TNM - ի N, in:0,1,2,3,x each with a|b");
            $table->string("M")->nullable()->default(NULL)->comment("TNM - ի M, in:0,1,x each with a|b");

            $table->string("Grade")->nullable()->default(NULL)->comment("TNM - ի Grade, in:1,2,3,4,x");
            $table->string("L")->nullable()->default(NULL)->comment("TNM - ի L, in:0,1,x");
            $table->string("V")->nullable()->default(NULL)->comment("TNM - ի V, in:0,1,2,x");
            $table->string("pycmr")->nullable()->default(NULL)->comment("TNM - ի 'tumor classification', in:p,y,c,m,r");

            $table->unsignedSmallInteger("department_id")->nullable()->default(NULL)->comment("Բաժանմունք");

            $table->unsignedSmallInteger("chamber")->nullable()->default(NULL)->comment("Հիվանդասենյակ");
            $table->boolean("is_paid")->nullable()->default(NULL)->comment("Արդյոք վճարովի է սենյակը");
            $table->unsignedSmallInteger("bed")->nullable()->default(NULL)->comment("Մահճակալ");
            $table->unsignedSmallInteger("days_qty")->nullable()->default(NULL)->comment("Օրերի քանակ");

            $table->unsignedSmallInteger("clinic_id")->nullable()->default(NULL)->comment("Ու՞մ կողմից է ուղարկված հիվանդը");

            $table->boolean("is_urgent")->nullable()->default(NULL)->comment("Ստացիոնար է ուղարկվել անհետաձգելի ցուցումով");
            $table->boolean("is_planned")->nullable()->default(NULL)->comment("Ստացիոնար է ուղարկվել պլանային կարգով");
            $table->boolean("from_disease_start")->nullable()->default(NULL)->comment("Ստացիոնար է ուղարկվել Հիվանդության սկզբից");
            $table->unsignedTinyInteger("hours_later")->nullable()->default(NULL)->comment("Ստացիոնար է ընդունվել վնասվածք x ժամ անց");

            $table->boolean("malaria_endemic_zone")->nullable()->default(NULL)->comment("Արդյոք եղել է մալարիայի էնդեմիկ գոտում");

            $table->tinyInteger("times_hospitalized")->nullable()->default(NULL)->comment("քանի անգամ է հոսպիտալացվել հիվանդության հետ կապված");

            $table->string("work_efficiency_status")->nullable()->default(NULL)->comment("Աշխատուակության վերականգնամ վիճակ");
            $table->string("work_efficiency_comment")->nullable()->default(NULL)->comment("Աշխատուակության վերականգնամ վիճակի՝ այլ պատճառ");

            $table->unsignedBigInteger("attending_doctor_id")->nullable()->default(NULL);
            $table->unsignedBigInteger("department_head_id")->nullable()->default(NULL);

            $table->foreign("patient_id")->references("id")->on("patients");
            $table->foreign("clinic_id")->references("id")->on("clinics");
            $table->foreign("department_id")->references("id")->on("departments");
            $table->foreign("attending_doctor_id")->references("id")->on("users");
            $table->foreign("department_head_id")->references("id")->on("users");

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
        Schema::dropIfExists('stationaries');
    }
}
