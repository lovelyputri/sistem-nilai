<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class NilaiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil guru aktif yang punya mata pelajaran
        $guruAktif = User::where('role', 'guru')
            ->where('status', 'aktif')
            ->with('mataPelajaran')
            ->get();

        // Ambil semua siswa
        $siswa = Siswa::all();

        if ($guruAktif->isEmpty() || $siswa->isEmpty()) {
            $this->command->warn('Tidak ada guru aktif atau siswa. Jalankan GuruSeeder dan SiswaSeeder terlebih dahulu.');
            return;
        }

        // Data nilai: setiap guru mengisi nilai untuk setiap siswa di mapel yang diajarkannya
        // Unique constraint: (id_user, id_mata_pelajaran) — 1 guru hanya bisa input 1 nilai per mapel
        $nilaiData = [
            // Ahmad Santoso (MTK, BD)
            ['guru_email' => 'ahmad.santoso@smk.sch.id', 'mapel_kode' => 'MTK', 'nilai_list' => [85, 78, 92, 88, 76, 90, 82, 74]],
            ['guru_email' => 'ahmad.santoso@smk.sch.id', 'mapel_kode' => 'BD',  'nilai_list' => [80, 75, 88, 83, 70, 87, 79, 68]],
            // Siti Nurhaliza (BIN)
            ['guru_email' => 'siti.nurhaliza@smk.sch.id', 'mapel_kode' => 'BIN', 'nilai_list' => [88, 85, 90, 87, 80, 93, 84, 77]],
            // Dimas Pratama (PAI, PENJAS)
            ['guru_email' => 'dimas.pratama@smk.sch.id', 'mapel_kode' => 'PAI',    'nilai_list' => [92, 88, 95, 91, 85, 94, 89, 83]],
            ['guru_email' => 'dimas.pratama@smk.sch.id', 'mapel_kode' => 'PENJAS', 'nilai_list' => [78, 82, 86, 80, 75, 88, 77, 72]],
            // Nabila Azzahra (BIG)
            ['guru_email' => 'nabila.azzahra@smk.sch.id', 'mapel_kode' => 'BIG', 'nilai_list' => [72, 68, 80, 76, 65, 82, 71, 60]],
            // Hendra Wijaya (KEMUH, ARAB)
            ['guru_email' => 'hendra.wijaya@smk.sch.id', 'mapel_kode' => 'KEMUH', 'nilai_list' => [90, 87, 93, 89, 84, 91, 88, 82]],
            ['guru_email' => 'hendra.wijaya@smk.sch.id', 'mapel_kode' => 'ARAB',  'nilai_list' => [75, 70, 82, 78, 68, 84, 73, 65]],
        ];

        $mapelByKode = MataPelajaran::pluck('id', 'kode');
        $guruByEmail = User::pluck('id', 'email');
        $siswaList   = $siswa->values();

        foreach ($nilaiData as $row) {
            $idUser    = $guruByEmail[$row['guru_email']] ?? null;
            $idMapel   = $mapelByKode[$row['mapel_kode']] ?? null;

            if (!$idUser || !$idMapel) {
                continue;
            }

            foreach ($row['nilai_list'] as $i => $nilai) {
                $s = $siswaList->get($i);
                if (!$s) continue;

                // Hindari duplikat (unique: id_user, id_mata_pelajaran per siswa tidak unik tapi id_siswa tidak di-unique)
                // Tabel nilais unique (id_user, id_mata_pelajaran) — artinya 1 guru 1 nilai per mapel (bukan per siswa)
                // Jadi kita insert satu nilai per (id_user, id_mata_pelajaran), tidak per siswa
                // Gunakan firstOrCreate untuk menghindari error duplicate
                Nilai::firstOrCreate(
                    [
                        'id_user'          => $idUser,
                        'id_mata_pelajaran' => $idMapel,
                    ],
                    [
                        'id_siswa' => $s->id,
                        'nilai'    => $nilai,
                    ]
                );
            }
        }
    }
}
