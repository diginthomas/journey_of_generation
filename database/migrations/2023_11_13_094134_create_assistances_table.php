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
        Schema::create('assistances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('senior_id')->nullable()->constrained('users');
            $table->mediumText('message')->nullable();
            $table->integer('status')->default(1)->comment('1=>pending,2=>Approved,3=>Rejected');
            $table->boolean('volunteer_approval')->default(false)->comment('1=>volunteer approved');
            $table->commonFields();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistances');
    }
};
