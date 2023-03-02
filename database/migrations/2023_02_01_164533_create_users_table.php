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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id',255);
            $table->string('first_name',64)->nullable();
            $table->string('last_name',64)->nullable();
            $table->string('user_name',100)->unique();
            $table->string('gender',20)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',100);
            // $table->integer('department_id')->nullable();
            // $table->integer('designation_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->enum('user_type',['app','employee','vendor','bro','other']);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
			$table->unsignedBigInteger('state_id')->nullable();
			$table->unsignedBigInteger('city_id')->nullable();
            $table->string('postcode',20)->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_admin')->default(0);
            // $table->unsignedBigInteger('asset_file_id')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->foreign('parent_id')->references('id')->on('users');
			$table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
			$table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
			$table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            // $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            // $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            // $table->foreign('asset_file_id')->references('id')->on('asset_files')->onDelete('cascade');
            $table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

