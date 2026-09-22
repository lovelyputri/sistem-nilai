<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('template_deskripsi', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('predikat', 1);

            $table->text('deskripsi');

            $table->boolean('is_default')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('template_deskripsi');
    }
};
