<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * List siswa + nilai sesuai kelas dan mata pelajaran guru
     * Query param: ?id_user=1&kelas=X-A
     */
    public function index(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
        ], [
            'id_user.required' => 'id_user (ID guru) wajib diisi.',
            'id_user.exists'   => 'Guru tidak ditemukan.',
        ]);

        /** @var User $guru */
        $guru = User::findOrFail($request->id_user);

        abort_if($guru->role !== 'guru', 403, 'User bukan guru.');

        $mataPelajaran = $guru->mataPelajaran()->first();

        if (!$mataPelajaran) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Guru belum memiliki mata pelajaran.',
            ], 403);
        }

        $kelasTerpilih = $request->get('kelas');
        $daftarKelas   = Siswa::select('kelas')->distinct()->orderBy('kelas')->pluck('kelas');

        $siswa = collect();

        if ($kelasTerpilih) {
            $siswa = Siswa::with([
                'nilai' => function ($q) use ($mataPelajaran, $guru) {
                    $q->where('id_mata_pelajaran', $mataPelajaran->id)
                      ->where('id_user', $guru->id);
                }
            ])
            ->whereRaw('LOWER(TRIM(kelas)) = ?', [strtolower(trim($kelasTerpilih))])
            ->get();
        }

        return response()->json([
            'status'         => 'success',
            'guru'           => ['id' => $guru->id, 'name' => $guru->name],
            'mata_pelajaran' => $mataPelajaran->only('id', 'name', 'kode'),
            'kelas_terpilih' => $kelasTerpilih,
            'daftar_kelas'   => $daftarKelas,
            'data'           => $siswa,
        ]);
    }

    /**
     * Input / update nilai siswa
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user'  => 'required|exists:users,id',
            'id_siswa' => 'required|exists:siswas,id',
            'nilai'    => 'required|numeric|min:0|max:100',
        ], [
            'id_user.required'  => 'id_user (ID guru) wajib diisi.',
            'id_user.exists'    => 'Guru tidak ditemukan.',
            'id_siswa.required' => 'Siswa wajib dipilih.',
            'id_siswa.exists'   => 'Siswa tidak ditemukan.',
            'nilai.required'    => 'Nilai wajib diisi.',
            'nilai.numeric'     => 'Nilai harus berupa angka.',
            'nilai.min'         => 'Nilai minimal 0.',
            'nilai.max'         => 'Nilai maksimal 100.',
        ]);

        /** @var User $guru */
        $guru = User::findOrFail($request->id_user);
        abort_if($guru->role !== 'guru', 403, 'User bukan guru.');

        $mataPelajaran = $guru->mataPelajaran()->first();

        if (!$mataPelajaran) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Guru belum memiliki mata pelajaran.',
            ], 403);
        }

        $nilai = Nilai::updateOrCreate(
            [
                'id_siswa'          => $request->id_siswa,
                'id_mata_pelajaran' => $mataPelajaran->id,
            ],
            [
                'id_user' => $guru->id,
                'nilai'   => $request->nilai,
            ]
        );

        $siswa = Siswa::findOrFail($request->id_siswa);
        $nilai->load('siswa:id,name', 'mataPelajaran:id,name', 'guru:id,name');

        return response()->json([
            'status'  => 'success',
            'message' => "Nilai {$siswa->name} berhasil disimpan.",
            'data'    => $nilai,
        ], 201);
    }

    /**
     * Update nilai
     */
    public function update(Request $request, Nilai $nilai)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nilai'   => 'required|numeric|min:0|max:100',
        ]);

        $guru = User::findOrFail($request->id_user);

        if ($nilai->id_user !== $guru->id) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Anda tidak berhak mengubah nilai ini.',
            ], 403);
        }

        $nilai->update(['nilai' => $request->nilai]);
        $nilai->load('siswa:id,name', 'mataPelajaran:id,name');

        return response()->json([
            'status'  => 'success',
            'message' => 'Nilai berhasil diperbarui.',
            'data'    => $nilai,
        ]);
    }

    /**
     * Hapus nilai
     */
    public function destroy(Nilai $nilai)
    {
        $namaSiswa = $nilai->siswa->name ?? 'Siswa';
        $nilai->delete();

        return response()->json([
            'status'  => 'success',
            'message' => "Nilai {$namaSiswa} berhasil dihapus.",
        ]);
    }
}
