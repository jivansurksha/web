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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->bigIncrements('id','255');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->string('name_prefix','40')->nullable();
            $table->string('name_suffix','40')->nullable();
            $table->string('previous_email','100')->nullable();
            $table->integer('credits')->default(0);
            $table->dateTime('credits_updated_at')->nullable();
            $table->dateTime('date_terms_agreed')->nullable();
            $table->dateTime('date_email_changed')->nullable();
            $table->string('primary_role','10')->nullable();
            $table->dateTime('privacy_data_request_date')->nullable();
            $table->smallInteger('privacy_data_request_count')->default(0);
            $table->dateTime('deletion_request_date')->nullable();
            $table->dateTime('deletion_action_date')->nullable();
            $table->enum('education_level', ['none','primary','secondary','college','graduate','post-graduate'])->default('none');
            $table->tinyInteger('has_side_business')->nullable();
            $table->smallInteger('num_side_businesses')->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infos');
    }
};
