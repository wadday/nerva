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
        Schema::table('users', function (Blueprint $table) {
            $table->after('email', function (Blueprint $table) {
                $table->string('username')->unique();
                $table->string('avatar')->nullable();
                $table->string('banner')->nullable();
                $table->text('bio')->nullable();
                $table->string('location')->nullable();
                $table->boolean('is_verified')->default(false);
                $table->string('streamer_level')->nullable()->index();
                $table->boolean('is_live')->default(false)->index();
                $table->unsignedInteger('followers_count')->default(0);
                $table->unsignedInteger('following_count')->default(0);
                $table->unsignedInteger('gifts_received')->default(0);
            });
        });
    }
};
