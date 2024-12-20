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
            $table->string('single_bed_rent')->after('hostel_features')->nullable();
            $table->string('double_bed_rent')->after('single_bed_rent')->nullable();
            $table->string('triple_bed_rent')->after('double_bed_rent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hostels', function (Blueprint $table) {
            $table->dropColumn('single_bed_rent');
            $table->dropColumn('double_bed_rent');
            $table->dropColumn('triple_bed_rent');
        });
    }
};
