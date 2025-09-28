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
        Schema::create('live_chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('username');
            $table->text('message');
            $table->foreignId('track_id')->nullable();
            $table->foreignId('stream_id')->nullable();
            $table->timestamp('sent_at')->useCurrent();
            $table->boolean('is_flagged')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->string('ip_address')->nullable();
            $table->json('metadata')->nullable();
            $table->string('gift_type')->nullable();
            $table->integer('gift_value')->nullable();
            $table->string('reaction_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_chats');
    }
};
