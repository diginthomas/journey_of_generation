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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_first_name');
            $table->string('user_last_name')->nullable();
            $table->string('user_email')->unique();
            $table->string('user_phone_number')->nullable();
            $table->string('user_address')->nullable();
            $table->date('user_date_of_birth')->nullable();
            $table->string('user_gender')->nullable();
            $table->string('user_type')->nullable();
            $table->string('user_image')->nullable();
            $table->string('user_country')->nullable();
            $table->string('user_city')->nullable();
            $table->integer('user_role')->comment('1=>Admin,2=>Senior,3=>Volunteer');
            $table->timestamp('user_email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
