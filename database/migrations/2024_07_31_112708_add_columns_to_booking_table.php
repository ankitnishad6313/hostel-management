<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('order_id')->after('id');
            $table->string('transaction_id')->after('order_id');
            $table->string('plateform_fee')->after('due_payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('order_id');
            $table->dropColumn('transaction_id');
            $table->dropColumn('plateform_fee');
        });
    }
};
