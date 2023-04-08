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
        Schema::table('asset_files', function (Blueprint $table) {
            $table->string('url')->after('filepath');
            $table->string('original_name')->after('filename');
            $table->string('created_by')->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_files', function (Blueprint $table) {
            //
            $table->dropColumn('url');
            $table->dropColumn('original_name');
            $table->dropColumn('created_by');
        });
    }
};
