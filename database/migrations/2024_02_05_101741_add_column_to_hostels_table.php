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
        Schema::table('hostels', function (Blueprint $table) {
            $table->text('restaurants')->nullable()->after('hostel_status');
            $table->text('shopping_malls')->nullable()->after('hostel_status');
            $table->text('coachings')->nullable()->after('hostel_status');
            $table->text('hospitals')->nullable()->after('hostel_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hostels', function (Blueprint $table) {
            $table->dropColumn('restaurants');
            $table->dropColumn('shopping_malls');
            $table->dropColumn('coachings');
            $table->dropColumn('hospitals');
        });
    }
};
