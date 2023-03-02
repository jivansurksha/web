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
        Schema::create('amenities', function (Blueprint $table) {
			$table->id();
			$table->string('name');
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->boolean('is_active')->default(0);
			$table->unsignedBigInteger('created_by');
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('amenities');
    }
};
