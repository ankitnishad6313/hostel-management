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
        Schema::table('users', function (Blueprint $table) {
            $table->string('aadhar_no',12)->unique()->after('added_by')->nullable();
            $table->string('aadhar_front')->after('aadhar_no')->nullable();
            $table->string('aadhar_back')->after('aadhar_front')->nullable();
            $table->string('alternate_no', 10)->unique()->after('phone')->nullable();
            $table->text('current_address')->after('address')->nullable();
            $table->string('blood_group')->after('added_by')->nullable();
            $table->string('university')->after('added_by')->nullable();
            $table->string('course_year')->after('added_by')->nullable();
            $table->string('father_mobile_no')->after('father_name')->unique()->nullable();
            $table->string('mother_mobile_no')->after('mother_name')->unique()->nullable();
            $table->string('guardian_name')->after('mother_mobile_no')->nullable();
            $table->string('guardian_mobile_no')->after('guardian_name')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('aadhar_no');
            $table->dropColumn('alternate_no');
            $table->dropColumn('current_address');
            $table->dropColumn('blood_group');
            $table->dropColumn('university');
            $table->dropColumn('course_year');
            $table->dropColumn('father_mobile_no');
            $table->dropColumn('mother_mobile_no');
            $table->dropColumn('guardian_name');
            $table->dropColumn('guardian_mobile_no');
        });
    }
};
