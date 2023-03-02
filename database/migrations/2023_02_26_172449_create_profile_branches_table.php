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
        Schema::create('profile_branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->boolean('is_primary')->default(0);
            $table->string('contact_person',64);
            $table->string('email',100);
            $table->string('phone',20);
            $table->string('address',200);
            // $table->unsignedBigInteger('country_id');
			$table->unsignedBigInteger('state_id');
			$table->unsignedBigInteger('city_id');
            $table->string('postcode',20);
            $table->string('latitude',100);
            $table->string('longitude',100);
            $table->boolean('is_active')->default(1);
            // $table->longText('asset_file_id');
            $table->unsignedBigInteger('created_by');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_branches');
    }
};
