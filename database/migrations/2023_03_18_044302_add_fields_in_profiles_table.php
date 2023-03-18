<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('profile_branches');

        Schema::table('profiles', function (Blueprint $table) {
            $table->boolean('is_primary')->default(0)->after('feature_id');
            $table->string('address',200)->nullable()->after('is_primary');
            // $table->unsignedBigInteger('country_id');
			$table->unsignedBigInteger('state_id')->nullable()->after('address');
			$table->unsignedBigInteger('city_id')->nullable()->after('state_id');
            $table->string('postcode',20)->nullable()->after('city_id');
            $table->string('latitude',100)->nullable()->after('postcode');
            $table->string('longitude',100)->nullable()->after('latitude');
            // $table->longText('asset_file_id');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
			$table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
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
            $table->dropColumn('is_primary');
            $table->dropColumn('address');
            $table->dropForeign('state_id');
            $table->dropForeign('city_id');
            $table->dropColumn('state_id');
            $table->dropColumn('city_id');
            $table->dropColumn('postcode');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
};
