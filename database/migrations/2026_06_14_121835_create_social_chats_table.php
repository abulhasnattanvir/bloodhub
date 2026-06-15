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
        Schema::create('social_chats', function (Blueprint $table) {
            $table->id();

            $table->string('site_name')->nullable();

            $table->string('whatsapp_number')->nullable();
            $table->string('whatsapp_title')->nullable();
            $table->text('whatsapp_message')->nullable();
            $table->boolean('whatsapp_enabled')->default(true);
            $table->string('facebook_page_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_chats');
    }
};