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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); 
            $table->unsignedBigInteger('owner_id'); 
            $table->foreignId('hostel_id')->constrained(); 
            $table->foreignId('room_id')->constrained(); 
            $table->foreignId('bed_id')->constrained(); 
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->date('due_date')->nullable();
            $table->double('rent')->nullable();
            $table->double('payment')->default(0);
            $table->double('due_payment')->default(0);
            $table->double('security_amount')->default(0);
            $table->enum('payment_status', ['pending', 'success', 'failed'])->default('pending');
            $table->enum('payment_mode', ['cash', 'card', 'online', 'other'])->default('online');
            $table->enum('booking_status', ['pending', 'booked', 'cancel'])->default('pending');
            $table->enum('boarding_status', ['pending', 'onboarding', 'checked_out'])->default('pending');
            $table->date('lock_in_period_date')->nullable();
            $table->date('next_due_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
