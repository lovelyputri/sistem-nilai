<?php

namespace Database\Seeders;

use App\Models\TemplateDeskripsi;
use Illuminate\Database\Seeder;

class TemplateDeskripsiSeeder extends Seeder
{
    public function run(): void
    {
        TemplateDeskripsi::query()->delete();

        TemplateDeskripsi::create([
            'nama' => 'Sangat Baik',
            'predikat' => 'A',
            'deskripsi' =>
                '{siswa} menunjukkan penguasaan materi yang sangat baik, mampu memahami konsep {mapel} dengan tepat, serta menerapkannya dalam berbagai kegiatan pembelajaran secara mandiri dan bertanggung jawab.',
            'is_default' => true,
        ]);

        TemplateDeskripsi::create([
            'nama' => 'Baik',
            'predikat' => 'B',
            'deskripsi' =>
                '{siswa} menunjukkan penguasaan materi yang baik, mampu memahami konsep {mapel} dengan baik, serta menerapkannya dalam berbagai kegiatan pembelajaran dengan bertanggung jawab.',
            'is_default' => true,
        ]);

        TemplateDeskripsi::create([
            'nama' => 'Cukup',
            'predikat' => 'C',
            'deskripsi' =>
                '{siswa} menunjukkan pemahaman yang cukup terhadap materi {mapel}, namun masih perlu meningkatkan pemahaman konsep, ketelitian, dan penerapan materi dalam kegiatan pembelajaran.',
            'is_default' => true,
        ]);

        TemplateDeskripsi::create([
            'nama' => 'Perlu Bimbingan',
            'predikat' => 'D',
            'deskripsi' =>
                '{siswa} menunjukkan pemahaman dasar terhadap materi {mapel}, namun masih memerlukan bimbingan dan latihan secara berkelanjutan untuk meningkatkan penguasaan kompetensi.',
            'is_default' => true,
        ]);
    }
}
