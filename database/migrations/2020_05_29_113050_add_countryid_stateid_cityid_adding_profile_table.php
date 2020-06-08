<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryidStateidCityidAddingProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->unsignedInteger('country_id')->nullable()->after('slug');
            $table->unsignedInteger('state_id')->nullable()->after('country_id');
            $table->unsignedInteger('city_id')->nullable()->after('state_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('country_id');
            $table->dropColumn('state_id');
            $table->dropColumn('city_id');
        });
    }
}
