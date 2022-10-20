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
        Schema::create('asset_files', function (Blueprint $table) {
            $table->bigIncrements('id','255');
            $table->bigInteger('users_id')->nullable(true);
            $table->string('filename','100');
            $table->string('filetype','20');
            $table->string('filepath','255');
            $table->smallInteger('width')->nullable(true);
            $table->smallInteger('height')->nullable(true);;
            $table->integer('size')->nullable(true);;
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_files');
    }
};
