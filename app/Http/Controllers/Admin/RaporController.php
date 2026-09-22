<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeskripsiRapor;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RaporController extends Controller
{
    /**
     * Halaman utama ekspor rapor.
     *
     * Admin memilih kelas terlebih dahulu,
     * kemudian memilih siswa.
     */
    public function index(Request $request)
    {
        $kelasList = Siswa::query()
            ->where('status', 'aktif')
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        $siswaList = collect();

        if ($request->filled('kelas')) {
            $siswaList = Siswa::query()
                ->where('status', 'aktif')
                ->where('kelas', $request->kelas)
                ->orderBy('name')
                ->get();
        }

        return view('admin.rapor.index', [
            'kelasList' => $kelasList,
            'siswaList' => $siswaList,
        ]);
    }

    /**
     * Preview rapor.
     */
    public function preview(Request $request)
    {
        $request->validate([
            'kelas' => ['required', 'string'],
            'id_siswa' => ['required', 'integer'],
        ]);

        $siswa = $this->getSiswa($request);

        $dataNilai = $this->getDataNilai($siswa);

        $nilaiTerisi = $dataNilai
            ->filter(fn ($item) => $item['nilai'] !== null);

        $rataRata = $nilaiTerisi->isNotEmpty()
            ? round($nilaiTerisi->avg('nilai'), 2)
            : null;

        return view('admin.rapor.preview', [
            'siswa' => $siswa,
            'dataNilai' => $dataNilai,
            'rataRata' => $rataRata,
        ]);
    }

    /**
     * Export rapor menjadi PDF.
     */
    public function exportPdf(Request $request)
    {
        $request->validate([
            'kelas' => ['required', 'string'],
            'id_siswa' => ['required', 'integer'],
        ]);

        $siswa = $this->getSiswa($request);

        $dataNilai = $this->getDataNilai($siswa);

        $nilaiTerisi = $dataNilai
            ->filter(fn ($item) => $item['nilai'] !== null);

        $rataRata = $nilaiTerisi->isNotEmpty()
            ? round($nilaiTerisi->avg('nilai'), 2)
            : null;

        $pdf = Pdf::loadView('admin.rapor.pdf', [
            'siswa' => $siswa,
            'dataNilai' => $dataNilai,
            'rataRata' => $rataRata,
        ]);

        $pdf->setPaper('A4', 'portrait');

        $namaFile = 'Rapor-' .
            preg_replace(
                '/[^A-Za-z0-9\-]/',
                '-',
                $siswa->name
            ) .
            '.pdf';

        return $pdf->download($namaFile);
    }

    /**
     * Mengambil siswa berdasarkan kelas dan ID siswa.
     */
    private function getSiswa(Request $request): Siswa
    {
        return Siswa::query()
            ->where('id', $request->id_siswa)
            ->where('kelas', $request->kelas)
            ->where('status', 'aktif')
            ->firstOrFail();
    }

    /**
     * Mengambil SEMUA mata pelajaran.
     *
     * Nilai:
     * - Jika ada nilai 0, tetap ditampilkan sebagai 0.
     * - Jika belum ada nilai, ditampilkan null/-.
     *
     * Predikat dan deskripsi:
     * - SEPENUHNYA berasal dari DeskripsiRapor.
     * - Tidak dibuat oleh Admin.
     * - Tidak dibuat oleh Controller.
     */
    private function getDataNilai(Siswa $siswa)
    {
        /*
        |--------------------------------------------------------------------------
        | Semua mata pelajaran
        |--------------------------------------------------------------------------
        */
        $mataPelajaran = MataPelajaran::query()
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Nilai siswa
        |--------------------------------------------------------------------------
        */
        $nilaiSiswa = $siswa->nilai()
            ->with('guru')
            ->get()
            ->keyBy('id_mata_pelajaran');

        /*
        |--------------------------------------------------------------------------
        | Predikat + deskripsi yang dibuat guru
        |--------------------------------------------------------------------------
        */
        $deskripsiSiswa = DeskripsiRapor::query()
            ->where('id_siswa', $siswa->id)
            ->get()
            ->keyBy('id_mata_pelajaran');

        /*
        |--------------------------------------------------------------------------
        | Gabungkan semua mata pelajaran
        |--------------------------------------------------------------------------
        */
        return $mataPelajaran->map(function ($mapel) use (
            $nilaiSiswa,
            $deskripsiSiswa
        ) {
            $nilaiData = $nilaiSiswa->get($mapel->id);

            $deskripsiData = $deskripsiSiswa->get($mapel->id);

            /*
            |--------------------------------------------------------------------------
            | Nilai
            |--------------------------------------------------------------------------
            |
            | Jangan menggunakan ?? '-' karena nilai 0 harus tetap 0.
            |
            */
            $nilai = $nilaiData
                ? $nilaiData->nilai
                : null;

            return [
                'id_mata_pelajaran' => $mapel->id,

                'mata_pelajaran' => $mapel->name ?? '-',

                'kode' => $mapel->kode ?? '-',

                /*
                 * Nilai berasal dari tabel nilais.
                 */
                'nilai' => $nilai,

                /*
                 * Predikat HARUS dari guru.
                 *
                 * Tidak ada fallback predikat otomatis.
                 */
                'predikat' => $deskripsiData?->predikat ?? '-',

                /*
                 * Deskripsi HARUS dari guru.
                 *
                 * Tidak membuat deskripsi otomatis.
                 */
                'deskripsi' => $deskripsiData?->deskripsi ?? '-',

                'guru' => $nilaiData?->guru?->name ?? '-',
            ];
        });
    }
}
