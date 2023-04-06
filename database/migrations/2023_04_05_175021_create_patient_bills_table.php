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
        Schema::create('patient_bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('raised_by');
            $table->unsignedBigInteger('raised_to');
            $table->unsignedBigInteger('booking_id');
            $table->decimal('bill_amount', $precision = 8, $scale = 2);
            $table->date('raised_date');
            $table->time('raised_time');
            $table->enum('payment_mode',['cash','online'])->nullable();
            $table->string('transection_id')->nullable();
            $table->decimal('paid_amount', $precision = 8, $scale = 2)->nullable();
            $table->enum('status',['pending','failed','success'])->default('pending');
            $table->string('description')->nullable();
            $table->date('paid_date')->nullable();
            $table->time('paid_time')->nullable();
            $table->decimal('commission', $precision = 8, $scale = 2)->nullable();
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
            $table->foreign('raised_by')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('raised_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_bills');
    }
};
