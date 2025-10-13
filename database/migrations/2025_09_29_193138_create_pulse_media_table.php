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
        Schema::create('pulse_media', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20)->index();
            $table->string('filename')->index();
            $table->string('path');
            $table->string('mime_type');
            $table->string('disk', '10');
            $table->foreignId('pulse_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
