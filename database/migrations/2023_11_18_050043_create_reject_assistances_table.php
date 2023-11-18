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
        Schema::create('reject_assistances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->nullable()->constrained('users');
            $table->foreignId('assistance_id')->nullable()->constrained('assistances');
            $table->commonFields();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reject_assistances');
    }
};
