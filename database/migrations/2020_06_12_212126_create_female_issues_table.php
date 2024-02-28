<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFemaleIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Ենթադրում եմ, որ բլոկը կունենա  "edit-update" լրացնոցի համար (user_id),
         * իսկ այլ բժիշկների համար "+", բլոկի դաշտերը, թեկուզ մեկը լրացնելու համար
         * Ցույց տալը հավանաբար աղյուսակով՝ որպես ամսաթիվ - created_at
         *
         * New-row-creation-Validation: Դուք չեք նշել ոչ մի դաշտ, կամ - անհրաժեշտ է լրացնել առնվազն մեկ դաշտ
         */
        Schema::create('female_issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ambulator_id');
            $table->unsignedBigInteger('user_id');

            $table->tinyInteger('number_of_births')->nullable()->comment('ծննդաբերությունների քանակը');
            $table->tinyInteger('number_of_abortions')->nullable()->comment('վիժումների քանակը');
            $table->date('date_of_last_birth')->nullable()->comment('վերջին ծննդաբերության ամսաթիվը');
            $table->text('breastfeeding_complications')->nullable()->comment('բարդություններ կրծքով կերակրելու շրջանում');
            $table->text('breast_inflammation')->nullable()->comment('կրծքագեղձի բորբոքում');
            $table->text('menstruation')->nullable()->comment('դաշտանը՝ ազատ դաշտ');
            $table->date('menstruation_date')->nullable()->comment('դաշտանը՝ ամսաթիվ ');
            $table->timestamps();

            $table->foreign('ambulator_id')->references('id')->on('ambulators')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('female_issues');
    }
}
