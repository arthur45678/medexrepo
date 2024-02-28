<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCareAccounting1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_care_accounting1s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("stationary_id")->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('responsible_nurse');

            $table->unsignedSmallInteger('department_id')->nullable();
            $table->unsignedSmallInteger('moved_department_id')->nullable()->comment('Տեղափոխված է (բաժանմունքի անվանումը)');
            $table->unsignedSmallInteger('moved_department2_id')->nullable()->comment('Տեղափոխված է (բաժանմունքի անվանումը)');
            $table->unsignedSmallInteger('hospital_department_id')->nullable()->comment('Հոսպիտալացման բաժանմունքի համարը N');
            $table->enum('case_status',['free','paid'])->nullable()->comment('Դեպքի կարգավիճակ');
            $table->string('tickets_N')->nullable()->comment('Ուղեգիր համար N');
            $table->date('date')->nullable()->comment('Ուղեգրման ամսաթիվը');
            $table->string('c')->nullable()->comment('c');
            $table->unsignedSmallInteger("clinic_id")->nullable()->default(NULL)->comment("Ուղեգրող բժշկական հաստատության անվանումը, կոդը");
            $table->unsignedSmallInteger("clinic2_id")->nullable()->default(NULL)->comment("Ուղեգրող այլ հաստատություններ");
            $table->longText("clinic_comments")->nullable()->default(NULL)->comment("Ուղեգրող այլ հաստատություններ նկարագրություն");
            $table->string("referral_N")->nullable()->default(NULL)->comment(" Ուղեգրի, գրության համարը N");
            $table->string("ReportNumberN")->nullable()->default(NULL)->comment("Հաշվետվության համարը N");
            $table->unsignedMediumInteger('service_id')->nullable()->comment('Մատուցված ծառայության տեսակը մ/օր ծառայություն');
            $table->unsignedMediumInteger('service2_id')->nullable()->comment('Մատուցված ծառայության տեսակը մ/օր ծառայություն');
            $table->unsignedMediumInteger('service3_id')->nullable()->comment('Մատուցված ծառայության տեսակը մ/օր ծառայություն');
//            $table->unsignedMediumInteger('service_delivery_id')->nullable()->comment('Մատուցված ծառայության տեսակը մ/օր ծառայություն');
            $table->unsignedBigInteger('scholarships_id')->nullable()->comment('Պետպատվերի հոդվածը');
            $table->unsignedBigInteger('scholarships2_id')->nullable()->comment('Պետպատվերի հոդվածը 2');
            $table->unsignedBigInteger('scholarships3_id')->nullable()->comment('Պետպատվերի հոդվածը 3');
            $table->longText('replenishment_type')->nullable()->comment('Համալրման տեսակը');
            $table->longText('replenishment_size')->nullable()->comment('Համալրման չափը');
            $table->longText('social_package_comments')->nullable()->comment('լրացման ազատ դաշտ․․․');
            $table->longText('field_comments')->nullable()->comment('Հիմնական կլինիկական եզրափակիչ ախտորոշումը');
            $table->unsignedBigInteger('social_package_id')->nullable();

            $table->foreign("social_package_id")->references("id")->on("social_packages");
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('responsible_nurse')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('moved_department_id','MDI')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('moved_department2_id','MDI2')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('hospital_department_id','HDI')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign("clinic_id")->references("id")->on("clinics");
            $table->foreign("clinic2_id")->references("id")->on("clinics");
            $table->foreign('service_id')->references('id')->on('service_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('service2_id')->references('id')->on('service_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('service3_id')->references('id')->on('service_lists')->onDelete('restrict')->onUpdate('cascade');
//            $table->foreign('service_delivery_id','SDI')->references('id')->on('service_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('scholarships_id')->references('id')->on('scholarships_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('scholarships2_id')->references('id')->on('scholarships_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('scholarships3_id')->references('id')->on('scholarships_lists')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign("stationary_id")->references("id")->on("stationaries");

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
        Schema::dropIfExists('medical_care_accounting1s');
    }
}
