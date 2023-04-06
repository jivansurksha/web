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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_id');
            $table->string('model_type');
            $table->enum('type',['credit','debit'])->nullable();
            $table->decimal('amount', $precision = 8, $scale = 2)->nullable();
            $table->unsignedBigInteger('withdraw_request_id')->nullable();
            $table->string('purpose')->nullable();
            $table->decimal('balance_amount', $precision = 8, $scale = 2)->nullable();
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
            $table->foreign('withdraw_request_id')->references('id')->on('withdraw_requests')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
};
