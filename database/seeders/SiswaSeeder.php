<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftarSiswa = [
            ['nis' => '2024001', 'name' => 'Ahmad Fauzi',      'kelas' => 'X.PPLG'],
            ['nis' => '2024002', 'name' => 'Budi Santoso',     'kelas' => 'X.TJKJ'],
            ['nis' => '2024003', 'name' => 'Citra Dewi',       'kelas' => 'X.LK'],
            ['nis' => '2024004', 'name' => 'Dina Rahayu',      'kelas' => 'X.TKR'],
            ['nis' => '2024005', 'name' => 'Eko Prasetyo',     'kelas' => 'XI.RPL'],
            ['nis' => '2024006', 'name' => 'Fitri Handayani',  'kelas' => 'XI.TKJ'],
            ['nis' => '2024007', 'name' => 'Gilang Permana',   'kelas' => 'XI.LK'],
            ['nis' => '2024008', 'name' => 'Hani Kusuma',      'kelas' => 'XI.TKR'],
        ];

        foreach ($daftarSiswa as $siswa) {
            Siswa::create($siswa);
        }
    }
}
