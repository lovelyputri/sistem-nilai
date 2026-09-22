<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $totalMapel = MataPelajaran::count();

        /*
        |--------------------------------------------------------------------------
        | QUERY DATA SISWA
        |--------------------------------------------------------------------------
        */
        $query = Siswa::with([
            'nilai.mataPelajaran',
            'nilai.guru',
        ]);

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('nis', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('kelas') && $request->kelas !== 'Semua Kelas') {
            $query->where('kelas', $request->kelas);
        }

        /*
        |--------------------------------------------------------------------------
        | DATA SEMUA SISWA SESUAI FILTER
        | Dipakai untuk ranking agar tidak hanya menghitung halaman aktif.
        |--------------------------------------------------------------------------
        */
        $filteredSiswa = (clone $query)
            ->orderBy('kelas')
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TRANSFORM DATA SISWA
        |--------------------------------------------------------------------------
        */
        $transformSiswa = function (Siswa $siswa) use ($totalMapel) {
            $jumlahNilai = $siswa->nilai->count();

            $totalNilai = $siswa->nilai->sum('nilai');

            $rataRata = $totalMapel > 0
                ? round($totalNilai / $totalMapel, 2)
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
        };

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */
        $perPage = (int) $request->input('per_page', 10);

        if (!in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 10;
        }

        $siswaPaginate = $query
            ->orderBy('kelas')
            ->orderBy('name')
            ->paginate($perPage)
            ->withQueryString();

        $siswaPaginate->getCollection()->transform($transformSiswa);

        /*
        |--------------------------------------------------------------------------
        | RANKING KELAS
        |--------------------------------------------------------------------------
        */
        $rankingSiswa = collect();

        if ($request->filled('kelas') && $request->kelas !== 'Semua Kelas') {
            $rankingSiswa = $filteredSiswa
                ->map($transformSiswa)
                ->filter(function ($siswa) {
                    return !is_null($siswa['rata_rata']);
                })
                ->sortByDesc('rata_rata')
                ->values();
        }

        /*
        |--------------------------------------------------------------------------
        | STATISTIK GLOBAL
        |--------------------------------------------------------------------------
        */
        $allSiswa = Siswa::with('nilai')->get();

        $totalSiswa = $allSiswa->count();

        $rataRataPerSiswa = $allSiswa
            ->map(function (Siswa $siswa) use ($totalMapel) {

                if ($totalMapel === 0) {
                    return null;
                }

                $totalNilai = $siswa->nilai->sum('nilai');

                return round(
                    $totalNilai / $totalMapel,
                    2
                );
            })
            ->filter(
                fn ($nilai) => $nilai !== null
            )
            ->values();

        $rataRataKeseluruhan = $rataRataPerSiswa->isNotEmpty()
            ? round($rataRataPerSiswa->avg(), 2)
            : 0;

        $rataRataTertinggi = $rataRataPerSiswa->isNotEmpty()
            ? round($rataRataPerSiswa->max(), 2)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | TOP SISWA GLOBAL
        |--------------------------------------------------------------------------
        */
        $topSiswa = $allSiswa
            ->map(function (Siswa $siswa) use ($totalMapel) {

                if ($totalMapel === 0) {
                    return null;
                }

                $totalNilai = $siswa->nilai->sum('nilai');

                return [
                    'id' => $siswa->id,
                    'nama' => $siswa->name,
                    'kelas' => $siswa->kelas,
                    'rata_rata' => round(
                        $totalNilai / $totalMapel,
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
        $daftarKelas = Siswa::query()
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        /*
        |--------------------------------------------------------------------------
        | MATA PELAJARAN
        |--------------------------------------------------------------------------
        */
        $mataPelajaran = MataPelajaran::query()
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'kode',
            ]);

        return view('admin.nilai.index', [
            'siswaPaginate' => $siswaPaginate,
            'mataPelajaran' => $mataPelajaran,
            'totalMapel' => $totalMapel,
            'totalSiswa' => $totalSiswa,
            'rataRataKeseluruhan' => $rataRataKeseluruhan,
            'rataRataTertinggi' => $rataRataTertinggi,
            'daftarKelas' => $daftarKelas,
            'topSiswa' => $topSiswa,
            'rankingSiswa' => $rankingSiswa,
        ]);
    }

    public function show(Siswa $siswa)
    {
        $siswa->load([
            'nilai.mataPelajaran',
            'nilai.guru',
        ]);

        $totalMapel = MataPelajaran::count();

        $totalNilai = $siswa->nilai->sum('nilai');

        $jumlahNilai = $siswa->nilai->count();

        $rataRata = $totalMapel > 0
            ? round(
                $totalNilai / $totalMapel,
                2
            )
            : null;

        $mataPelajaranBelumDiisi = MataPelajaran::whereNotIn(
            'id',
            $siswa->nilai->pluck('id_mata_pelajaran')
        )->get([
            'id',
            'name',
            'kode',
        ]);

        return view(
            'admin.nilai.show',
            compact(
                'siswa',
                'totalMapel',
                'totalNilai',
                'jumlahNilai',
                'rataRata',
                'mataPelajaranBelumDiisi'
            )
        );
    }

    public function destroy(Nilai $nilai)
    {
        $namaSiswa = $nilai->siswa?->name ?? 'Siswa';

        $nilai->delete();

        return redirect()
            ->back()
            ->with(
                'success',
                "Nilai {$namaSiswa} berhasil dihapus."
            );
    }
}