<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPatientFirstInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_first_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('patient_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_first_infos', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // $table->dropForeign('patient_first_infos_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
