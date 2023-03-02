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
        //
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('contact_person',64)->nullable();
            $table->string('phone',20);
            $table->string('email',100);
            $table->string('alt_number',20)->nullable();
            $table->string('org_name',20);
            $table->string('reg_number',20)->nullable();
            $table->integer('type')->nullable();//1:indivisual,2:llp,3:opc,4:propietorship,5:partnership,6:pvt. ltd., 7:ltd, 8:other
            $table->string('speciality',20)->nullable();
            // $table->longText('facility_id')->nullable();
            $table->longText('amenity_id')->nullable();
            $table->longText('feature_id')->nullable();
            $table->boolean('is_active')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('profiles');
    }
};
