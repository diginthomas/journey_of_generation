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
        Schema::create('histories', function (Blueprint $table) {
          $table->id();
          $table->string('table_name')->nullable();
          $table->json('data')->nullable();
          $table->integer('primary_key')->nullable();
          $table->commonFields(); // from app/Providers/CommonFieldServiceProvider.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
