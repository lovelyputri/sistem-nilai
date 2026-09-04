<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Rekap nilai semua siswa
     */
    public function index(Request $request)
    {
        $totalMapel = MataPelajaran::count();

        /*
        |--------------------------------------------------------------------------
        | QUERY SISWA
        |--------------------------------------------------------------------------
        */
        $query = Siswa::with([
            'nilai.mataPelajaran',
            'nilai.guru',
        ]);

        // Filter pencarian nama
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('name', 'like', '%' . $search . '%');
        }

        // Filter kelas
        if (
            $request->filled('kelas') &&
            $request->kelas !== 'Semua Kelas'
        ) {
            $query->where('kelas', $request->kelas);
        }

        // Pagination
        $perPage = $request->input('per_page', 10);

        $siswaPaginate = $query
            ->orderBy('kelas')
            ->orderBy('name')
            ->paginate($perPage)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | TRANSFORM DATA SISWA
        |--------------------------------------------------------------------------
        */
        $siswaPaginate->getCollection()->transform(
            function (Siswa $siswa) use ($totalMapel) {

                $jumlahNilai = $siswa->nilai->count();

                $totalNilai = $siswa->nilai->sum('nilai');

                $rataRata = $jumlahNilai > 0
                    ? round($totalNilai / $jumlahNilai, 2)
                    : null;

                $progress = $totalMapel > 0
                    ? round(($jumlahNilai / $totalMapel) * 100)
                    : 0;

                return [
                    'id' => $siswa->id,

                    'name' => $siswa->name,

                    'nis' => $siswa->nis,

                    'kelas' => $siswa->kelas,

                    'nilai_mapel' => $siswa->nilai,

                    'jumlah_mapel_diikuti' => $jumlahNilai,

                    'rata_rata' => $rataRata,

                    'lengkap' => $jumlahNilai >= $totalMapel,

                    'progress' => min($progress, 100),
                ];
            }
        );

        /*
        |--------------------------------------------------------------------------
        | STATISTIK SELURUH SISWA
        |--------------------------------------------------------------------------
        */
        $allSiswa = Siswa::with('nilai')->get();

        $totalSiswa = $allSiswa->count();

        $rataRataPerSiswa = $allSiswa
            ->map(function (Siswa $siswa) {

                $jumlahNilai = $siswa->nilai->count();

                if ($jumlahNilai === 0) {
                    return null;
                }

                return $siswa->nilai->avg('nilai');
            })
            ->filter();

        $rataRataKeseluruhan = $rataRataPerSiswa->isNotEmpty()
            ? round($rataRataPerSiswa->avg(), 2)
            : 0;

        $rataRataTertinggi = $rataRataPerSiswa->isNotEmpty()
            ? round($rataRataPerSiswa->max(), 2)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | RANKING SISWA
        |--------------------------------------------------------------------------
        |
        | Ranking berdasarkan rata-rata seluruh nilai siswa.
        |
        */
        $topSiswa = $allSiswa
            ->map(function (Siswa $siswa) {

                $jumlahNilai = $siswa->nilai->count();

                if ($jumlahNilai === 0) {
                    return null;
                }

                return [
                    'id' => $siswa->id,

                    'nama' => $siswa->name,

                    'kelas' => $siswa->kelas,

                    'rata_rata' => round(
                        $siswa->nilai->avg('nilai'),
                        2
                    ),
                ];
            })
            ->filter()
            ->sortByDesc('rata_rata')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | DAFTAR KELAS
        |--------------------------------------------------------------------------
        */
        $daftarKelas = Siswa::select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        /*
        |--------------------------------------------------------------------------
        | MATA PELAJARAN
        |--------------------------------------------------------------------------
        */
        $mataPelajaran = MataPelajaran::orderBy('name')
            ->get([
                'id',
                'name',
                'kode',
            ]);

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */
        return view('admin.nilai.index', [
            'siswaPaginate' => $siswaPaginate,

            'mataPelajaran' => $mataPelajaran,

            'totalMapel' => $totalMapel,

            'totalSiswa' => $totalSiswa,

            'rataRataKeseluruhan' => $rataRataKeseluruhan,

            'rataRataTertinggi' => $rataRataTertinggi,

            'daftarKelas' => $daftarKelas,

            'topSiswa' => $topSiswa,
        ]);
    }

    /**
     * Detail nilai satu siswa
     */
    public function show(Siswa $siswa)
    {
        $siswa->load([
            'nilai.mataPelajaran',
            'nilai.guru',
        ]);

        $totalMapel = MataPelajaran::count();

        $totalNilai = $siswa->nilai->sum('nilai');

        $jumlahNilai = $siswa->nilai->count();

        $rataRata = $jumlahNilai > 0
            ? round($totalNilai / $jumlahNilai, 2)
            : null;

        $mataPelajaranBelumDiisi = MataPelajaran::whereNotIn(
            'id',
            $siswa->nilai->pluck('id_mata_pelajaran')
        )->get([
            'id',
            'name',
            'kode',
        ]);

        return view('admin.nilai.show', compact(
            'siswa',
            'totalMapel',
            'totalNilai',
            'jumlahNilai',
            'rataRata',
            'mataPelajaranBelumDiisi'
        ));
    }

    /**
     * Hapus nilai
     */
    public function destroy(Nilai $nilai)
    {
        $namaSiswa = $nilai->siswa->name ?? 'Siswa';

        $nilai->delete();

        return redirect()
            ->back()
            ->with(
                'success',
                "Nilai {$namaSiswa} berhasil dihapus."
            );
    }
}