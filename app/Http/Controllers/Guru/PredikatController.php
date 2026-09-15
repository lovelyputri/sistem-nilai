<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\DeskripsiRapor;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TemplateDeskripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PredikatController extends Controller
{
    private const KKM = 75;

    public function index(Request $request)
    {
        $guru = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | DAFTAR KELAS GURU
        |--------------------------------------------------------------------------
        */

        $daftarKelas = $guru->kelas()
            ->orderBy('kelas')
            ->pluck('kelas')
            ->unique()
            ->values();

        $kelasTerpilih = $request->input('kelas');

        if ($kelasTerpilih) {
            abort_unless(
                $daftarKelas->contains($kelasTerpilih),
                403,
                'Anda tidak mengajar kelas ini.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DAFTAR SISWA
        |--------------------------------------------------------------------------
        */

        $daftarSiswa = collect();

        if ($kelasTerpilih) {

            $daftarSiswa = Siswa::query()
                ->where('kelas', $kelasTerpilih)
                ->where('status', 'aktif')
                ->orderBy('name')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | HITUNG STATUS DESKRIPSI PER SISWA
            |--------------------------------------------------------------------------
            |
            | Contoh:
            | nilai tersedia = 3
            | deskripsi tersimpan = 2
            |
            | Maka status = 2 / 3 mapel
            |
            */

            if ($daftarSiswa->isNotEmpty()) {

                $siswaIds = $daftarSiswa->pluck('id');

                $jumlahNilaiPerSiswa = Nilai::query()
                    ->where('id_user', $guru->id)
                    ->whereIn('id_siswa', $siswaIds)
                    ->selectRaw('id_siswa, COUNT(*) as total')
                    ->groupBy('id_siswa')
                    ->pluck('total', 'id_siswa');

                $jumlahDeskripsiPerSiswa = DeskripsiRapor::query()
                    ->where('id_user', $guru->id)
                    ->whereIn('id_siswa', $siswaIds)
                    ->selectRaw('id_siswa, COUNT(*) as total')
                    ->groupBy('id_siswa')
                    ->pluck('total', 'id_siswa');

                $daftarSiswa->each(function ($siswa) use (
                    $jumlahNilaiPerSiswa,
                    $jumlahDeskripsiPerSiswa
                ) {

                    $siswa->total_nilai =
                        (int) ($jumlahNilaiPerSiswa[$siswa->id] ?? 0);

                    $siswa->total_deskripsi =
                        (int) ($jumlahDeskripsiPerSiswa[$siswa->id] ?? 0);

                });
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SISWA TERPILIH
        |--------------------------------------------------------------------------
        */

        $siswaTerpilih = $request->input('siswa');

        $siswa = null;

        if ($siswaTerpilih && $kelasTerpilih) {

            $siswa = $daftarSiswa->firstWhere(
                'id',
                (int) $siswaTerpilih
            );

            abort_unless(
                $siswa,
                403,
                'Siswa tidak berada pada kelas yang dipilih.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | MAPEL YANG SUDAH MEMILIKI NILAI
        |--------------------------------------------------------------------------
        */

        $daftarMapel = collect();

        if ($siswa) {

            $mapelGuru = $guru->mataPelajaran;

            $nilaiMapelIds = Nilai::query()
                ->where('id_user', $guru->id)
                ->where('id_siswa', $siswa->id)
                ->pluck('id_mata_pelajaran');

            $daftarMapel = $mapelGuru
                ->whereIn('id', $nilaiMapelIds)
                ->sortBy('name')
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | MAPEL TERPILIH
        |--------------------------------------------------------------------------
        */

        $mapelTerpilih = $request->input('mapel_id');

        $mataPelajaran = null;
        $nilai = null;
        $predikat = null;
        $template = null;
        $deskripsi = null;
        $deskripsiTersimpan = null;

        if ($mapelTerpilih && $siswa) {

            $mataPelajaran = $daftarMapel->firstWhere(
                'id',
                (int) $mapelTerpilih
            );

            abort_unless(
                $mataPelajaran,
                403,
                'Anda tidak mengampu mata pelajaran ini atau nilai siswa belum tersedia.'
            );


            /*
            |--------------------------------------------------------------------------
            | AMBIL NILAI
            |--------------------------------------------------------------------------
            */

            $nilai = Nilai::query()
                ->where('id_user', $guru->id)
                ->where('id_siswa', $siswa->id)
                ->where(
                    'id_mata_pelajaran',
                    $mataPelajaran->id
                )
                ->first();

            abort_unless(
                $nilai,
                404,
                'Nilai siswa belum tersedia.'
            );


            /*
            |--------------------------------------------------------------------------
            | TENTUKAN PREDIKAT
            |--------------------------------------------------------------------------
            */

            $predikat = $this->tentukanPredikat(
                (float) $nilai->nilai
            );


            /*
            |--------------------------------------------------------------------------
            | TEMPLATE DEFAULT
            |--------------------------------------------------------------------------
            */

            $template = TemplateDeskripsi::query()
                ->where('predikat', $predikat)
                ->where('is_default', true)
                ->first();


            /*
            |--------------------------------------------------------------------------
            | DESKRIPSI YANG SUDAH DISIMPAN
            |--------------------------------------------------------------------------
            */

            $deskripsiTersimpan = DeskripsiRapor::query()
                ->where('id_user', $guru->id)
                ->where('id_siswa', $siswa->id)
                ->where(
                    'id_mata_pelajaran',
                    $mataPelajaran->id
                )
                ->first();


            /*
            |--------------------------------------------------------------------------
            | JIKA SUDAH ADA → TAMPILKAN DATA TERSIMPAN
            |--------------------------------------------------------------------------
            |
            | JIKA BELUM ADA → GUNAKAN TEMPLATE DEFAULT
            |
            */

            if ($deskripsiTersimpan) {

                $deskripsi = $deskripsiTersimpan->deskripsi;

            } elseif ($template) {

                $deskripsi = $this->replacePlaceholder(
                    $template->deskripsi,
                    $siswa,
                    $mataPelajaran
                );
            }
        }


        return view(
            'guru.rapot.predikat.index',
            compact(
                'daftarKelas',
                'kelasTerpilih',
                'daftarSiswa',
                'siswa',
                'siswaTerpilih',
                'daftarMapel',
                'mapelTerpilih',
                'mataPelajaran',
                'nilai',
                'predikat',
                'template',
                'deskripsi',
                'deskripsiTersimpan'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN / UPDATE DESKRIPSI
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $guru = Auth::user();

        $validated = $request->validate([
            'kelas' => [
                'required',
                Rule::in(
                    $guru->kelas()
                        ->pluck('kelas')
                        ->unique()
                        ->toArray()
                ),
            ],

            'id_siswa' => [
                'required',
                'integer',
                'exists:siswas,id',
            ],

            'id_mata_pelajaran' => [
                'required',
                'integer',
                'exists:mata_pelajarans,id',
            ],

            'deskripsi' => [
                'required',
                'string',
                'max:2000',
            ],

        ], [

            'kelas.required' =>
                'Kelas wajib dipilih.',

            'id_siswa.required' =>
                'Siswa wajib dipilih.',

            'id_mata_pelajaran.required' =>
                'Mata pelajaran wajib dipilih.',

            'deskripsi.required' =>
                'Deskripsi wajib diisi.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | VALIDASI SISWA
        |--------------------------------------------------------------------------
        */

        $siswa = Siswa::query()
            ->where('id', $validated['id_siswa'])
            ->where('kelas', $validated['kelas'])
            ->where('status', 'aktif')
            ->first();

        if (!$siswa) {

            return back()
                ->withInput()
                ->withErrors([
                    'id_siswa' =>
                        'Siswa tidak sesuai dengan kelas yang dipilih.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI MAPEL GURU
        |--------------------------------------------------------------------------
        */

        $mapelGuru = $guru->mataPelajaran()
            ->where(
                'mata_pelajarans.id',
                $validated['id_mata_pelajaran']
            )
            ->first();

        if (!$mapelGuru) {

            abort(
                403,
                'Anda tidak mengampu mata pelajaran ini.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK NILAI
        |--------------------------------------------------------------------------
        */

        $nilai = Nilai::query()
            ->where('id_user', $guru->id)
            ->where('id_siswa', $siswa->id)
            ->where(
                'id_mata_pelajaran',
                $mapelGuru->id
            )
            ->first();

        if (!$nilai) {

            return back()
                ->withInput()
                ->withErrors([
                    'id_mata_pelajaran' =>
                        'Nilai siswa untuk mata pelajaran ini belum tersedia.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PREDIKAT OTOMATIS
        |--------------------------------------------------------------------------
        */

        $predikat = $this->tentukanPredikat(
            (float) $nilai->nilai
        );


        /*
        |--------------------------------------------------------------------------
        | UPDATE ATAU CREATE
        |--------------------------------------------------------------------------
        */

        DeskripsiRapor::updateOrCreate(
            [
                'id_user' => $guru->id,
                'id_siswa' => $siswa->id,
                'id_mata_pelajaran' => $mapelGuru->id,
            ],
            [
                'predikat' => $predikat,
                'deskripsi' => $validated['deskripsi'],
            ]
        );


        return redirect()
            ->route(
                'guru.rapot.predikat.index',
                [
                    'kelas' => $validated['kelas'],
                    'siswa' => $siswa->id,
                    'mapel_id' => $mapelGuru->id,
                ]
            )
            ->with(
                'success',
                'Deskripsi rapor berhasil disimpan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS DESKRIPSI
    |--------------------------------------------------------------------------
    */

    public function destroy(DeskripsiRapor $deskripsiRapor)
    {
        $guru = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN DESKRIPSI MILIK GURU YANG LOGIN
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $deskripsiRapor->id_user === $guru->id,
            403,
            'Anda tidak memiliki akses untuk menghapus deskripsi ini.'
        );


        $kelas = $deskripsiRapor->siswa->kelas;
        $siswaId = $deskripsiRapor->id_siswa;


        $deskripsiRapor->delete();


        return redirect()
            ->route(
                'guru.rapot.predikat.index',
                [
                    'kelas' => $kelas,
                    'siswa' => $siswaId,
                ]
            )
            ->with(
                'success',
                'Deskripsi rapor berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | TENTUKAN PREDIKAT
    |--------------------------------------------------------------------------
    */

    private function tentukanPredikat(float $nilai): string
    {
        return match (true) {

            $nilai >= 90 => 'A',

            $nilai >= 80 => 'B',

            $nilai >= self::KKM => 'C',

            default => 'D',
        };
    }


    /*
    |--------------------------------------------------------------------------
    | GANTI PLACEHOLDER TEMPLATE
    |--------------------------------------------------------------------------
    */

    private function replacePlaceholder(
        string $template,
        Siswa $siswa,
        MataPelajaran $mataPelajaran
    ): string {

        return str_replace(
            [
                '{siswa}',
                '{mapel}',
            ],
            [
                $siswa->name,
                $mataPelajaran->name,
            ],
            $template
        );
    }
}
