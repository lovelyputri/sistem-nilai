<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('kelas');
            $table->unique(['id_user', 'kelas']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru_kelas');
    }
};
