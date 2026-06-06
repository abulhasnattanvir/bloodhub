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
        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();

            $table->string('page_title')->nullable();
            $table->string('page_subtitle')->nullable();
            $table->text('get_in_touch_text')->nullable();

            // Contact Information
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            // Map
            $table->longText('map_embed')->nullable();

            // Form Settings
            $table->string('form_title')->nullable();
            $table->string('success_message')->nullable()->default('Thank you! Your message has been sent successfully.');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_settings');
    }
};