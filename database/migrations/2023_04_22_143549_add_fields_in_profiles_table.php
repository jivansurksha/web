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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('description')->nullable()->after('speciality');
            $table->enum('speciality_type',['single','multispeciality','other'])->default('single')->after('type');
            $table->renameColumn('speciality','speciality_id');

        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('speciality_id')->nullable()->change();
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
            $table->dropColumn('description');
            $table->dropColumn('speciality_type');
            $table->string('speciality')->change();
        });
    }
};
