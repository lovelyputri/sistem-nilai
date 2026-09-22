<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RapotController extends Controller
{
    public function index(Request $request): View
    {
        $kelasGuru = Auth::user()
            ->kelas()
            ->pluck('kelas')
            ->unique()
            ->values();

        $kelasTerpilih = $request->get('kelas');

        if ($kelasTerpilih && !$kelasGuru->contains($kelasTerpilih)) {
            abort(403, 'Anda tidak mengajar kelas ini.');
        }

        $siswa = collect();

        if ($kelasTerpilih) {
            $siswa = Siswa::query()
                ->where('kelas', $kelasTerpilih)
                ->orderBy('name')
                ->get();
        }

        return view('guru.rapot.index', [
            'kelasGuru' => $kelasGuru,
            'kelasTerpilih' => $kelasTerpilih,
            'siswa' => $siswa,
        ]);
    }

    public function show(Siswa $siswa): View
    {
        $kelasGuru = Auth::user()
            ->kelas()
            ->pluck('kelas');

        abort_unless(
            $kelasGuru->contains($siswa->kelas),
            403,
            'Siswa ini bukan bagian dari kelas Anda.'
        );

        $nilai = collect([
            [
                'kode' => 'MTK',
                'mapel' => 'Matematika',
                'nilai' => 88,
                'predikat' => 'A',
            ],
            [
                'kode' => 'BIN',
                'mapel' => 'Bahasa Indonesia',
                'nilai' => 86,
                'predikat' => 'A',
            ],
            [
                'kode' => 'BING',
                'mapel' => 'Bahasa Inggris',
                'nilai' => 84,
                'predikat' => 'B+',
            ],
            [
                'kode' => 'PWEB',
                'mapel' => 'Pemrograman Web',
                'nilai' => 92,
                'predikat' => 'A',
            ],
            [
                'kode' => 'BD',
                'mapel' => 'Basis Data',
                'nilai' => 89,
                'predikat' => 'A',
            ],
            [
                'kode' => 'PKK',
                'mapel' => 'Produk Kreatif dan Kewirausahaan',
                'nilai' => 87,
                'predikat' => 'A',
            ],
        ]);

        $rataRata = round($nilai->avg('nilai'), 2);

        $kehadiran = [
            'sakit' => 2,
            'izin' => 1,
            'tanpa_keterangan' => 0,
        ];

        $ekstrakurikuler = collect([
            [
                'nama' => 'English Club',
                'predikat' => 'Baik',
                'keterangan' => 'Aktif mengikuti kegiatan.',
            ],
            [
                'nama' => 'Pramuka',
                'predikat' => 'Sangat Baik',
                'keterangan' => 'Aktif dan bertanggung jawab.',
            ],
        ]);

        $catatan = 'Pertahankan prestasi dan tingkatkan kemampuan dalam bekerja sama serta kedisiplinan.';

        $status = 'Naik Kelas';

        return view('guru.rapot.show', compact(
            'siswa',
            'nilai',
            'rataRata',
            'kehadiran',
            'ekstrakurikuler',
            'catatan',
            'status'
        ));
    }
}
