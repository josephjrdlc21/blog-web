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
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('suffix')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('type')->nullable();
            $table->string('status')->nullable()->default('inactive');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('source')->nullable();
            $table->string('filename')->nullable();
            $table->string('path')->nullable();
            $table->text('directory')->nullable();    
            $table->rememberToken()->nullable();
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
