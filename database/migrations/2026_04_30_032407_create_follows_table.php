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
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_profile_id')->constrained('profiles')->onDelete('cascade');
            $table->foreignId('following_profile_id')->constrained('profiles')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['follower_profile_id', 'following_profile_id']);
            $table->index(['following_profile_id', 'created_at']);
            $table->index(['follower_profile_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
