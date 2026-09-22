<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID mata pelajaran berdasarkan kode
        $mapelByKode = MataPelajaran::pluck('id', 'kode');

        $daftarGuru = [
            [
                'name'     => 'Ahmad Santoso',
                'email'    => 'ahmad.santoso@smk.sch.id',
                'nip'      => '198505152010011002',
                'password' => Hash::make('password123'),
                'role'     => 'guru',
                'status'   => 'aktif',
                'mapel'    => ['MTK', 'BD'],
                'kelas'    => ['X.PPLG', 'X.TJKJ', 'XI.RPL'],
            ],
            [
                'name'     => 'Siti Nurhaliza',
                'email'    => 'siti.nurhaliza@smk.sch.id',
                'nip'      => '199002102015032001',
                'password' => Hash::make('password123'),
                'role'     => 'guru',
                'status'   => 'aktif',
                'mapel'    => ['BIN'],
                'kelas'    => ['X.PPLG', 'X.LK'],
            ],
            [
                'name'     => 'Dimas Pratama',
                'email'    => 'dimas.pratama@smk.sch.id',
                'nip'      => '199103202016041005',
                'password' => Hash::make('password123'),
                'role'     => 'guru',
                'status'   => 'aktif',
                'mapel'    => ['PAI', 'PENJAS'],
                'kelas'    => ['XI.RPL'],
            ],
            [
                'name'     => 'Nabila Azzahra',
                'email'    => 'nabila.azzahra@smk.sch.id',
                'nip'      => '199304152017052003',
                'password' => Hash::make('password123'),
                'role'     => 'guru',
                'status'   => 'aktif',
                'mapel'    => ['BIG'],
                'kelas'    => ['XI.TKJ', 'XI.RPL'],
            ],
            [
                'name'     => 'Rudi Maulana',
                'email'    => 'rudi.maulana@smk.sch.id',
                'nip'      => '198912242014031004',
                'password' => Hash::make('password123'),
                'role'     => 'guru',
                'status'   => 'menunggu',
                'mapel'    => ['PW', 'PPB'],
                'kelas'    => [],
            ],
            [
                'name'     => 'Dewi Lestari',
                'email'    => 'dewi.lestari@smk.sch.id',
                'nip'      => '199308202019072005',
                'password' => Hash::make('password123'),
                'role'     => 'guru',
                'status'   => 'menunggu',
                'mapel'    => ['PKN', 'JAWA'],
                'kelas'    => [],
            ],
            [
                'name'     => 'Rizky Maulana',
                'email'    => 'rizky.maulana@smk.sch.id',
                'nip'      => '199507252018061004',
                'password' => Hash::make('password123'),
                'role'     => 'guru',
                'status'   => 'ditolak',
                'mapel'    => ['SI'],
                'kelas'    => [],
            ],
            [
                'name'     => 'Hendra Wijaya',
                'email'    => 'hendra.wijaya@smk.sch.id',
                'nip'      => '199001152013021003',
                'password' => Hash::make('password123'),
                'role'     => 'guru',
                'status'   => 'aktif',
                'mapel'    => ['KEMUH', 'ARAB'],
                'kelas'    => ['X.TKR', 'XI.TKJ'],
            ],
        ];

        foreach ($daftarGuru as $data) {
            // Lewati jika email sudah ada
            if (User::where('email', $data['email'])->exists()) {
                continue;
            }

            $guru = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'nip'      => $data['nip'],
                'password' => $data['password'],
                'role'     => $data['role'],
                'status'   => $data['status'],
            ]);

            // Attach mata pelajaran
            $mapelIds = [];
            foreach ($data['mapel'] as $kode) {
                if (isset($mapelByKode[$kode])) {
                    $mapelIds[] = $mapelByKode[$kode];
                }
            }
            if (!empty($mapelIds)) {
                $guru->mataPelajaran()->syncWithoutDetaching($mapelIds);
            }

            // Attach kelas (hanya untuk guru aktif)
            foreach ($data['kelas'] as $kelas) {
                $guru->kelas()->firstOrCreate(['kelas' => $kelas]);
            }
        }
    }
}
