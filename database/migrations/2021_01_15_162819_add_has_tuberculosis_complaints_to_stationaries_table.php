<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHasTuberculosisComplaintsToStationariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stationaries', function (Blueprint $table) {
            $table->boolean('has_tuberculosis_complaints')->nullable()->after('malaria_endemic_zone'); // ->default(0)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stationaries', function (Blueprint $table) {
            $table->dropColumn('has_tuberculosis_complaints');
        });
    }
}
