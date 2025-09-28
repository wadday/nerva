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
        Schema::create('streams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('host_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('ended_at')->nullable();
            $table->boolean('is_live')->index();
            $table->integer('audience_count')->default(0);
            $table->decimal('engagement_rate', 5, 2)->default(0.00);
            $table->decimal('retention_rate', 5, 2)->default(0.00);
            $table->boolean('enable_chat');
            $table->boolean('enable_gifts');
            $table->boolean('enable_reactions');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('song_stream', function (Blueprint $table) {
            $table->id();
            $table->foreignId('song_id')->constrained()->onDelete('cascade');
            $table->foreignId('stream_id')->constrained()->onDelete('cascade');
            $table->timestamp('played_at')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streams');
    }
};
