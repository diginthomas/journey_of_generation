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
        Schema::create('picnics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->string('image');
            $table->date('date');
            $table->time('time');
            $table->mediumText('description');
            $table->string('agenda');
            $table->boolean('status')->default(1)->comment('1=>active,0=>inactive');
            $table->commonFields();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('picnics');
    }
};