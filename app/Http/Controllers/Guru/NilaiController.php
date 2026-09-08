<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class NilaiController extends Controller
{
    /**
     * Batas nilai kelulusan (KKM) untuk menentukan status Tuntas / Belum Tuntas.
     * Ganti sesuai kebijakan sekolah kalau berbeda per mapel.
     */
    private const KKM = 75;

    /**
     * Daftar kelas yang ditugaskan ke guru yang sedang login (dari tabel guru_kelas).
     */
    private function kelasGuru(): \Illuminate\Support\Collection
    {
        return Auth::user()
            ->kelas() // relasi User::kelas() -> hasMany(GuruKelas)
            ->pluck('kelas');
    }

    /**
     * Daftar mata pelajaran yang diampu guru yang sedang login (pivot guru_mapel).
     */
    private function mapelGuruList()
    {
        return Auth::user()->mataPelajaran; // BelongsToMany
    }

    /**
     * Tentukan mapel yang sedang aktif dipakai guru untuk mengelola nilai.
     * Kalau guru mengampu >1 mapel, bisa dipilih lewat query string ?mapel_id=.
     * Default: mapel pertama yang diampu.
     */
    private function mapelAktif(Request $request, $daftarMapel): ?MataPelajaran
    {
        $mapelId = $request->input('mapel_id');

        if ($mapelId) {
            $dipilih = $daftarMapel->firstWhere('id', (int) $mapelId);
            if ($dipilih) {
                return $dipilih;
            }
        }

        return $daftarMapel->first();
    }

    /**
     * GET /guru/nilai
     */
    public function index(Request $request)
    {
        $daftarMapel = $this->mapelGuruList();
        $mapelGuru   = $this->mapelAktif($request, $daftarMapel);

        $kelasGuru = $this->kelasGuru();

        $search        = $request->input('search');
        $kelasTerpilih = $request->input('kelas');
        $perPage       = (int) $request->input('per_page', 10);

        // Kelas yang bisa difilter hanya kelas yang ditugaskan ke guru ini
        $daftarKelas = $kelasGuru;

        $query = Siswa::query()
            ->whereIn('siswas.kelas', $kelasGuru)
            ->leftJoin('nilais', function ($join) use ($mapelGuru) {
                $join->on('nilais.id_siswa', '=', 'siswas.id')
                     ->where('nilais.id_mata_pelajaran', '=', $mapelGuru?->id);
            })
            ->select(
                'siswas.id',
                'siswas.name',
                'siswas.nis',
                'siswas.nisn',
                'siswas.kelas',
                'nilais.id as nilai_id',
                'nilais.nilai as nilai'
            );

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('siswas.name', 'like', "%{$search}%")
                  ->orWhere('siswas.nis', 'like', "%{$search}%")
                  ->orWhere('siswas.nisn', 'like', "%{$search}%");
            });
        }

        if ($kelasTerpilih) {
            $query->where('siswas.kelas', $kelasTerpilih);
        }

        $siswaPaginate = $query
            ->orderBy('siswas.name')
            ->paginate($perPage)
            ->withQueryString();

        $siswaPaginate->getCollection()->transform(function ($row) {
            $sudahDinilai = !is_null($row->nilai_id);

            return [
                'id'            => $row->id,
                'name'          => $row->name,
                'nis'           => $row->nis,
                'nisn'          => $row->nisn,
                'kelas'         => $row->kelas,
                'nilai_id'      => $row->nilai_id,
                'nilai'         => $row->nilai !== null ? (float) $row->nilai : null,
                'sudah_dinilai' => $sudahDinilai,
                'status'        => $sudahDinilai
                    ? ($row->nilai >= self::KKM ? 'Tuntas' : 'Belum Tuntas')
                    : null,
            ];
        });

        // ===== Statistik, dihitung dari seluruh siswa di kelas guru (tidak ikut kefilter search) =====
        $totalSiswa = Siswa::whereIn('kelas', $kelasGuru)->count();

        $nilaiMapelQuery = Nilai::where('id_mata_pelajaran', $mapelGuru?->id)
            ->whereHas('siswa', function ($q) use ($kelasGuru) {
                $q->whereIn('kelas', $kelasGuru);
            });

        $jumlahSudahDinilai = (clone $nilaiMapelQuery)->distinct('id_siswa')->count('id_siswa');
        $jumlahBelumDinilai = max($totalSiswa - $jumlahSudahDinilai, 0);
        $persentasePenilaian = $totalSiswa > 0
            ? round(($jumlahSudahDinilai / $totalSiswa) * 100)
            : 0;
        $rataRataKeseluruhan = (clone $nilaiMapelQuery)->avg('nilai');

        // ===== Ranking kelas (hanya muncul kalau kelas difilter) =====
        $rankingSiswa = collect();

        if ($kelasTerpilih) {
            $rankingSiswa = Siswa::query()
                ->join('nilais', 'nilais.id_siswa', '=', 'siswas.id')
                ->where('nilais.id_mata_pelajaran', $mapelGuru?->id)
                ->where('siswas.kelas', $kelasTerpilih)
                ->select('siswas.name', 'siswas.nis', 'nilais.nilai')
                ->orderByDesc('nilais.nilai')
                ->get()
                ->map(fn ($row) => [
                    'name'  => $row->name,
                    'nis'   => $row->nis,
                    'nilai' => (float) $row->nilai,
                ]);
        }

        return view('guru.nilai.index', compact(
            'mapelGuru',
            'daftarMapel',
            'totalSiswa',
            'jumlahSudahDinilai',
            'jumlahBelumDinilai',
            'persentasePenilaian',
            'rataRataKeseluruhan',
            'daftarKelas',
            'search',
            'kelasTerpilih',
            'perPage',
            'siswaPaginate',
            'rankingSiswa'
        ));
    }

    /**
     * GET /guru/nilai/create
     */
    public function create(Request $request)
    {
        $daftarMapel = $this->mapelGuruList();
        $mapelGuru   = $this->mapelAktif($request, $daftarMapel);
        $kelasGuru   = $this->kelasGuru();

        // Hanya tampilkan siswa di kelas guru ini yang BELUM punya nilai untuk mapel ini
        $siswaBelumDinilai = Siswa::query()
            ->whereIn('kelas', $kelasGuru)
            ->whereDoesntHave('nilai', function ($q) use ($mapelGuru) {
                $q->where('id_mata_pelajaran', $mapelGuru?->id);
            })
            ->orderBy('name')
            ->get();

        return view('guru.nilai.create', compact('mapelGuru', 'daftarMapel', 'siswaBelumDinilai'));
    }

    /**
     * POST /guru/nilai
     */
    public function store(Request $request)
    {
        $daftarMapel = $this->mapelGuruList();
        $mapelId     = $request->input('id_mata_pelajaran') ?? $this->mapelAktif($request, $daftarMapel)?->id;

        // Pastikan mapel yang dipilih memang benar-benar diampu guru ini
        abort_unless($daftarMapel->contains('id', $mapelId), 403, 'Anda tidak mengampu mata pelajaran ini.');

        $validated = $request->validate([
            'id_siswa' => [
                'required',
                'exists:siswas,id',
                Rule::unique('nilais', 'id_siswa')
                    ->where(fn ($q) => $q->where('id_mata_pelajaran', $mapelId)),
            ],
            'nilai' => 'required|numeric|min:0|max:100',
        ], [
            'id_siswa.unique' => 'Siswa ini sudah memiliki nilai untuk mata pelajaran ini.',
        ]);

        Nilai::create([
            'id_siswa'          => $validated['id_siswa'],
            'id_mata_pelajaran' => $mapelId,
            'id_user'           => Auth::id(),
            'nilai'             => $validated['nilai'],
        ]);

        return redirect()
            ->route('guru.nilai.index')
            ->with('success', 'Nilai siswa berhasil ditambahkan.');
    }

    /**
     * GET /guru/nilai/{siswa}
     */
    public function show(Request $request, Siswa $siswa)
    {
        abort_unless($this->kelasGuru()->contains($siswa->kelas), 403, 'Siswa ini bukan bagian dari kelas Anda.');

        $daftarMapel = $this->mapelGuruList();
        $mapelGuru   = $this->mapelAktif($request, $daftarMapel);

        $nilai = Nilai::where('id_siswa', $siswa->id)
            ->where('id_mata_pelajaran', $mapelGuru?->id)
            ->first();

        return view('guru.nilai.show', compact('siswa', 'mapelGuru', 'nilai'));
    }

    /**
     * GET /guru/nilai/{nilai}/edit
     */
    public function edit(Nilai $nilai)
    {
        $this->authorizeNilai($nilai);

        $nilai->load('siswa', 'mataPelajaran');

        return view('guru.nilai.edit', compact('nilai'));
    }

    /**
     * PUT/PATCH /guru/nilai/{nilai}
     */
    public function update(Request $request, Nilai $nilai)
    {
        $this->authorizeNilai($nilai);

        $validated = $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        $nilai->update($validated);

        return redirect()
            ->route('guru.nilai.index')
            ->with('success', 'Nilai siswa berhasil diperbarui.');
    }

    /**
     * DELETE /guru/nilai/{nilai}
     */
    public function destroy(Nilai $nilai)
    {
        $this->authorizeNilai($nilai);

        $nilai->delete();

        return redirect()
            ->route('guru.nilai.index')
            ->with('success', 'Nilai siswa berhasil dihapus.');
    }

    /**
     * Pastikan guru cuma bisa ubah/hapus nilai yang dia input sendiri
     * (dicek dari kolom id_user di tabel nilais).
     */
    private function authorizeNilai(Nilai $nilai): void
    {
        abort_if(
            $nilai->id_user !== Auth::id(),
            403,
            'Anda tidak memiliki akses ke data nilai ini.'
        );
    }
}