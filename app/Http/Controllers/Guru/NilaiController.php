<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $guru */
        $guru = Auth::user();
        $mataPelajaran = $guru->mataPelajaran()->first();

        abort_if(! $mataPelajaran, 403, 'Anda belum memiliki mata pelajaran yang ditugaskan');

        $daftarKelas = Siswa::select('kelas')->distinct()->orderBy('kelas')->pluck('kelas');

        return view('guru.nilai.index', compact('guru', 'mataPelajaran', 'daftarKelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /** @var User $guru */
        $guru = Auth::user();
        $mataPelajaran = $guru->mataPelajaran()->first();

        abort_if(! $mataPelajaran, 403);

        $request->validate([
            'id_siswa' => 'required|exists:siswa,id',
            'nilai' => 'required|numeric|min:0|max:100'
        ], [
            'id_siswa.required' => 'Siswa wajib dipilih',
            'id_siswa.exists' => 'Siswa tidak ditemukan',
            'nilai.required' => 'Nilai wajib diiisi',
            'nilai.numeric' => 'Nilai harus berupa angka',
            'nilai.min' => 'Nilai minimal 0',
            'nilai.max' => 'Nilai maksimal 100', 
        ]);

        Nilai::updateOrCreate(
            [
                'id_siswa' => $request->id_siswa,
                'id_mata_pelajaran' => $mataPelajaran->id
            ],
            [
                'id_user' => $guru->id,
                'nilai' => $request->nilai,
            ]
        );

        $siswa = Siswa::find($request->id_siswa);
        $request->session()->put('kelas_terpilih', $siswa->kelas);

        return redirect()
            ->route('guru.nilai.index')
            ->with('sukses', "Nilai {$siswa->name} untuk mapel {$mataPelajaran->name} berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(Nilai $nilai)
    {
        /** @var User $guru */
        $guru = Auth::user();

        abort_if($nilai->id_user !== $guru->id, 404, 'Anda tidak dapat mengubah nilai ini');

        $nilai->load('siswa', 'mataPelajaran');

        return view('guru.nilai.edit', compact('nilai'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nilai $nilai)
    {
        /** @var User $guru */
        $guru = Auth::user();

        abort_if($nilai->id_user !== $guru->id, 403);

        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100'
        ]);

        $nilai->update(['nilai' => $request->nilai]);

        return redirect()
            ->route('guru.nilai.index')
            ->with('sukse', "Nilai berhasil diperbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function selectClass(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string',
        ], [
            'kelas.required' => 'Kelas wajib dipilih.'
        ]);

        $kelasTerpilih = $request->kelas;
        $request->session()->put('kelas_terpilih', $kelasTerpilih);

        /** @var User $guru */
        $guru = Auth::user();
        $mataPelajaran = $guru->mataPelajaran()->first();

        abort_if(! $mataPelajaran, 403);

        $siswa = Siswa::with([
            'nilai' => fn ($q) => $q->where('id_mata_pelajaran', $mataPelajaran->id)
                                    ->where('id_user', $guru->id),
        ])
        ->where('kelas', $kelasTerpilih)
        ->orderBy('name')
        ->get();

        $daftarKelas = Siswa::select('kelas')->distinct()->orderBy('kelas')->pluck('kelas');

        return view('guru.nilai.index', compact('guru', 'mataPelajaran', 'siswa', 'kelasTerpilih', 'daftarKelas'));
    }
}
