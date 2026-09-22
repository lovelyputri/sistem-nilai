<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deskripsi_rapor', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_user')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('id_siswa')
                ->constrained('siswas')
                ->cascadeOnDelete();

            $table->foreignId('id_mata_pelajaran')
                ->constrained('mata_pelajarans')
                ->cascadeOnDelete();

            $table->string('predikat', 1);

            $table->text('deskripsi');

            $table->timestamps();

            $table->unique([
                'id_user',
                'id_siswa',
                'id_mata_pelajaran',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deskripsi_rapor');
    }
};
