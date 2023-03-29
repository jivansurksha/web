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
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('status',['pending','confirmed','cancel','completed'])->default('pending')->after('booking_in');
            $table->string('cancel_reason')->nullable()->after('time');
            $table->integer('net_amount')->nullable()->after('cancel_reason');
            $table->date('admit_date')->nullable()->after('net_amount');
            $table->time('admit_time')->nullable()->after('admit_date');
            $table->date('discharge_date')->nullable()->after('admit_time');
            $table->time('discharge_time')->nullable()->after('discharge_date');
            $table->string('discharge_summery')->nullable()->after('discharge_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('cancel_reason');
            $table->dropColumn('net_amount');
            $table->dropColumn('admit_date');
            $table->dropColumn('admit_time');
            $table->dropColumn('discharge_date');
            $table->dropColumn('discharge_time');
            $table->dropColumn('discharge_summery');
        });
    }
};
