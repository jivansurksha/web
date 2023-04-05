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
        Schema::table('users', function (Blueprint $table) {
            $table->string('form_of_login',11)->nullable()->default('d')->after('user_type');//facebook=f, google=g, user id and password=d
            $table->string('google_id')->nullable()->after('user_type');
            $table->string('facebook_id')->nullable()->after('user_type');
            $table->string('password')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('form_of_login');
            $table->dropColumn('google_id');
            $table->dropColumn('facebook_id');
        });
    }
};
