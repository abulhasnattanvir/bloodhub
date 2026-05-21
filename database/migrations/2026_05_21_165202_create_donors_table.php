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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('profile_photo')->nullable(); // path to the photo
            $table->foreignId('blood_group_id')->constrained()->onDelete('cascade');
            $table->string('phone_number');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->text('address');
            $table->date('last_donation_date')->nullable();
            $table->enum('availability_status', ['available', 'not_available'])->default('available');
            $table->string('email')->nullable()->unique();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
