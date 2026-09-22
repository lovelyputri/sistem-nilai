<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftarMapel = [
            ['kode' => 'KEMUH',     'name' => 'Kemuhammadiyahan',                 'keterangan' => 'Mata Pelajaran Kemuhammadiyahan'],
            ['kode' => 'PENJAS',    'name' => 'Pendidikan Jasmani',               'keterangan' => 'Mata Pelajaran Pendidikan Jasmani'],
            ['kode' => 'JAWA',      'name' => 'Bahasa Jawa',                      'keterangan' => 'Mata Pelajaran Bahasa Jawa'],
            ['kode' => 'PKN',       'name' => 'Pendidikan Kewarganegaraan',       'keterangan' => 'Mata Pelajaran Pendidikan Kewarganegaraan'],
            ['kode' => 'ARAB',      'name' => 'Bahasa Arab',                      'keterangan' => 'Mata Pelajaran Bahasa Arab'],
            ['kode' => 'SI',        'name' => 'Sejarah Indonesia',                'keterangan' => 'Mata Pelajaran Sejarah Indonesia'],
            ['kode' => 'BD',        'name' => 'Basis Data',                       'keterangan' => 'Mata Pelajaran Basis Data'],
            ['kode' => 'BIG',       'name' => 'Bahasa Inggris',                   'keterangan' => 'Mata Pelajaran Bahasa Inggris'],
            ['kode' => 'PAI',       'name' => 'Pendidikan Agama Islam',           'keterangan' => 'Mata Pelajaran PAI'],
            ['kode' => 'MTK',       'name' => 'Matematika',                       'keterangan' => 'Mata Pelajaran Matematika'],
            ['kode' => 'PKK',       'name' => 'Produk Kreatif dan Kewirausahaan', 'keterangan' => 'Mata Pelajaran PKK'],
            ['kode' => 'M PILIH',   'name' => 'Mapel Pilihan',                    'keterangan' => 'Mata Pelajaran Pilihan'],
            ['kode' => 'PPB',       'name' => 'Pengembangan Perangkat Bergerak',  'keterangan' => 'Mata Pelajaran PPB'],
            ['kode' => 'BIN',       'name' => 'Bahasa Indonesia',                 'keterangan' => 'Mata Pelajaran Bahasa Indonesia'],
            ['kode' => 'PW',        'name' => 'Pemrogaman Website',               'keterangan' => 'Mata Pelajaran Pemograman Website'],
            

        ];

        foreach ($daftarMapel as $mapel) {
            MataPelajaran::create($mapel);
        }
    }
    
}
