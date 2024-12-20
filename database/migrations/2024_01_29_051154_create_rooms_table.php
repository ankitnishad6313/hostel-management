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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('hostel_id')->constrained();
            $table->string('floor');
            $table->enum('bed_type', [1, 2, 3])->comment('1 => Single Bed, 2 => Double Bed, 3 => Triple Bed');
            $table->string('room_name');
            $table->double('room_price');
            $table->enum('room_status', ['available', 'booked'])->default('available');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
