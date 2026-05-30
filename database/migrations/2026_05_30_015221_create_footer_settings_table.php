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
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            // ABOUT SECTION
            $table->text('about_text')->nullable();

            // SOCIAL LINKS (JSON)
            $table->json('social_links')->nullable();

            // QUICK LINKS (JSON)
            $table->json('quick_links')->nullable();

            // SERVICE LINKS (JSON)
            $table->json('service_links')->nullable();

            // FOOTER MENUS (JSON)
            $table->json('footer_menus')->nullable();

            // SUBSCRIBE SETTINGS
            $table->string('subscribe_title')->nullable();
            $table->text('subscribe_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};