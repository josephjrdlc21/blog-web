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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->index();
            $table->bigInteger('category_id')->nullable()->index();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('source')->nullable();
            $table->string('filename')->nullable();
            $table->string('path')->nullable();
            $table->text('directory')->nullable();
            $table->string('status')->nullable()->default('inactive');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
