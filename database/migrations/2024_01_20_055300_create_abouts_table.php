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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();

            $table->text('about_content');
            $table->string('about_image');

            $table->text('mission_content');
            $table->string('mission_image');

            $table->text('message_content');
            $table->string('message_image');

            $table->text('what_we_do_content');
            $table->string('what_we_do_image');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
