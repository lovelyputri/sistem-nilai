<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->string('nisn', 20)->nullable()->unique()->after('nis');
            $table->string('nik', 20)->nullable()->unique()->after('nisn');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('nik');
            $table->string('tempat_lahir', 100)->nullable()->after('jenis_kelamin');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('agama', 30)->nullable()->after('tanggal_lahir');
            $table->text('alamat')->nullable()->after('agama');
            $table->string('jurusan', 100)->nullable()->after('kelas');
            $table->string('angkatan', 10)->nullable()->after('jurusan');
            $table->year('tahun_masuk')->nullable()->after('angkatan');
            $table->string('no_hp', 20)->nullable()->after('tahun_masuk');
            $table->string('email')->nullable()->after('no_hp');
            $table->string('foto')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropUnique(['nisn']);
            $table->dropUnique(['nik']);
            $table->dropColumn([
                'nisn',
                'nik',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'agama',
                'alamat',
                'jurusan',
                'angkatan',
                'tahun_masuk',
                'no_hp',
                'email',
                'foto',
            ]);
        });
    }
};