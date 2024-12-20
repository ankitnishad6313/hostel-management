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
        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->comment('Hostel Owner Id => Owner of this Hostel');
            $table->string('hostel_name');
            $table->enum('property_type', ['hostel', 'pg']);
            $table->enum('gender_type', ['boys', 'girls', 'common']);
            $table->double('latitude', 10, 6)->nullable();
            $table->double('longitude', 10, 6)->nullable();
            $table->text('hostel_images')->nullable();
            $table->text('hostel_policy')->nullable();
            $table->text('hostel_description')->nullable();
            $table->string('city');
            $table->string('hostel_address');
            $table->text('hostel_features')->nullable();
            $table->string('youtube_video_link')->nullable();
            $table->string('hostel_membership')->nullable();
            $table->enum('hostel_status', ['active','inactive'])->default('active');
            $table->string('agent_id')->constrained()->nullable()->comment('Agent Id => Added by this Agent');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostels');
    }
};
