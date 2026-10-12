<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('konten');
            $table->string('gambar')->nullable(); // Bonus: upload gambar
            $table->timestamps();
            $table->softDeletes(); // Bonus: soft delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
