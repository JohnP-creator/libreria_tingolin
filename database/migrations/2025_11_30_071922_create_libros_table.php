<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('libros', function (Blueprint $table) {
      $table->id();
      $table->string('titulo');
      $table->string('autor');
      $table->string('isbn')->unique();
      $table->text('descripcion')->nullable();
      $table->decimal('precio', 8, 2);
      $table->integer('stock')->default(0);
      $table->string('editorial')->nullable();
      $table->integer('año_publicacion')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('libros');
  }
};
