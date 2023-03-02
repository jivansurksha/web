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
        Schema::create('bookings', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('booking_in');
            $table->enum('booking_for',['myself','spouse','children','friend','other']);
            $table->enum('status',['pending','confirmed','cancel']);
            $table->date('date')->nullable();
            $table->date('time')->nullable();
			$table->unsignedBigInteger('created_by');
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
