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
    private const KKM = 75;

    private function kelasGuru(): \Illuminate\Support\Collection
    {
        return Auth::user()
            ->kelas()
            ->pluck('kelas');
    }

    private function mapelGuruList()
    {
        return Auth::user()->mataPelajaran;
    }

    private function mapelAktif(Request $request, $daftarMapel): ?MataPelajaran
    {
        $mapelId = $request->input('mapel_id')
            ?? $request->input('id_mata_pelajaran');

        if ($mapelId) {
            $mapel = $daftarMapel->first(function ($mapel) use ($mapelId) {
                return (string) $mapel->id === (string) $mapelId;
            });

            if ($mapel) {
                return $mapel;
            }
        }

        return $daftarMapel->first();
    }

    public function index(Request $request)
    {
        $daftarMapel = $this->mapelGuruList();
        $mapelGuru = $this->mapelAktif($request, $daftarMapel);
        $kelasGuru = $this->kelasGuru();

        $search = $request->input('search');
        $kelasTerpilih = $request->input('kelas');
        $perPage = (int) $request->input('per_page', 10);

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
                'nilais.nilai'
            );

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('siswas.name', 'like', "%{$search}%")
                    ->orWhere('siswas.nis', 'like', "%{$search}%")
                    ->orWhere('siswas.nisn', 'like', "%{$search}%");
            });
        }

        if ($kelasTerpilih) {
            abort_unless(
                $kelasGuru->contains($kelasTerpilih),
                403,
                'Anda tidak mengajar kelas ini.'
            );

            $query->where('siswas.kelas', $kelasTerpilih);
        }

        $siswaPaginate = $query
            ->orderBy('siswas.name')
            ->paginate($perPage)
            ->withQueryString();

        $siswaPaginate->getCollection()->transform(function ($row) {
            $sudahDinilai = !is_null($row->nilai_id);

            return [
                'id' => $row->id,
                'name' => $row->name,
                'nis' => $row->nis,
                'nisn' => $row->nisn,
                'kelas' => $row->kelas,
                'nilai_id' => $row->nilai_id,
                'nilai' => $row->nilai !== null ? (float) $row->nilai : null,
                'sudah_dinilai' => $sudahDinilai,
                'status' => $sudahDinilai
                    ? ($row->nilai >= self::KKM ? 'Tuntas' : 'Belum Tuntas')
                    : null,
            ];
        });

        $daftarKelas = $kelasGuru;

        $totalSiswa = Siswa::whereIn('kelas', $kelasGuru)->count();

        $nilaiMapelQuery = Nilai::where(
            'id_mata_pelajaran',
            $mapelGuru?->id
        )->whereHas('siswa', function ($q) use ($kelasGuru) {
            $q->whereIn('kelas', $kelasGuru);
        });

        $jumlahSudahDinilai = (clone $nilaiMapelQuery)
            ->distinct('id_siswa')
            ->count('id_siswa');

        $jumlahBelumDinilai = max(
            $totalSiswa - $jumlahSudahDinilai,
            0
        );

        $persentasePenilaian = $totalSiswa > 0
            ? round(($jumlahSudahDinilai / $totalSiswa) * 100)
            : 0;

        $rataRataKeseluruhan = (clone $nilaiMapelQuery)->avg('nilai');

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
                    'name' => $row->name,
                    'nis' => $row->nis,
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

    public function create(Request $request)
    {
        $daftarMapel = $this->mapelGuruList();
        $mapelGuru = $this->mapelAktif($request, $daftarMapel);
        $kelasGuru = $this->kelasGuru();

        $kelasTerpilih = $request->input('kelas');

        if ($kelasTerpilih && !$kelasGuru->contains($kelasTerpilih)) {
            abort(403, 'Anda tidak mengajar kelas ini.');
        }

        $siswa = collect();

        if ($kelasTerpilih && $mapelGuru) {
            $siswa = Siswa::query()
                ->where('kelas', $kelasTerpilih)
                ->whereDoesntHave('nilai', function ($query) use ($mapelGuru) {
                    $query->where(
                        'id_mata_pelajaran',
                        $mapelGuru->id
                    );
                })
                ->orderBy('name')
                ->get();
        }

        return view('guru.nilai.create', [
            'mapelGuru' => $mapelGuru,
            'daftarMapel' => $daftarMapel,
            'mataPelajarans' => $daftarMapel,
            'kelasGuru' => $kelasGuru,
            'kelasTerpilih' => $kelasTerpilih,
            'siswa' => $siswa,
        ]);
    }

    public function store(Request $request)
    {
        $daftarMapel = $this->mapelGuruList();

        $mapelId = $request->input('id_mata_pelajaran')
            ?? $this->mapelAktif($request, $daftarMapel)?->id;

        abort_unless(
            $daftarMapel->contains('id', $mapelId),
            403,
            'Anda tidak mengampu mata pelajaran ini.'
        );

        $kelasGuru = $this->kelasGuru();

        $validated = $request->validate([
            'kelas' => [
                'required',
                Rule::in($kelasGuru->toArray()),
            ],
            'id_siswa' => [
                'required',
                'exists:siswas,id',
                Rule::unique('nilais', 'id_siswa')
                    ->where(fn ($query) => $query->where(
                        'id_mata_pelajaran',
                        $mapelId
                    )),
            ],
            'nilai' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],
        ], [
            'kelas.required' => 'Kelas wajib dipilih.',
            'kelas.in' => 'Anda tidak mengajar kelas ini.',
            'id_siswa.required' => 'Siswa wajib dipilih.',
            'id_siswa.exists' => 'Data siswa tidak ditemukan.',
            'id_siswa.unique' => 'Siswa ini sudah memiliki nilai untuk mata pelajaran ini.',
            'nilai.required' => 'Nilai wajib diisi.',
            'nilai.numeric' => 'Nilai harus berupa angka.',
            'nilai.min' => 'Nilai minimal adalah 0.',
            'nilai.max' => 'Nilai maksimal adalah 100.',
        ]);

        $siswa = Siswa::query()
            ->where('id', $validated['id_siswa'])
            ->where('kelas', $validated['kelas'])
            ->first();

        if (!$siswa) {
            return back()
                ->withInput()
                ->withErrors([
                    'id_siswa' => 'Siswa tidak sesuai dengan kelas yang dipilih.',
                ]);
        }

        Nilai::create([
            'id_siswa' => $validated['id_siswa'],
            'id_mata_pelajaran' => $mapelId,
            'id_user' => Auth::id(),
            'nilai' => $validated['nilai'],
        ]);

        return redirect()
            ->route('guru.nilai.index')
            ->with('success', 'Nilai siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa)
    {
        abort_unless(
            $this->kelasGuru()->contains($siswa->kelas),
            403,
            'Siswa ini bukan bagian dari kelas Anda.'
        );

        $daftarMapel = $this->mapelGuruList();

        $nilai = Nilai::with('mataPelajaran')
            ->where('id_siswa', $siswa->id)
            ->whereIn('id_mata_pelajaran', $daftarMapel->pluck('id'))
            ->orderBy('id_mata_pelajaran')
            ->get();

        $jumlahNilai = $nilai->count();

        $totalMapel = $daftarMapel->count();

        $rataRata = $jumlahNilai > 0
            ? $nilai->avg('nilai')
            : null;

        $mapelYangSudahDiisi = $nilai
            ->pluck('id_mata_pelajaran')
            ->toArray();

        $mataPelajaranBelumDiisi = $daftarMapel
            ->whereNotIn('id', $mapelYangSudahDiisi)
            ->values();

        return view('guru.nilai.show', [
            'siswa' => $siswa,
            'nilai' => $nilai,
            'jumlahNilai' => $jumlahNilai,
            'totalMapel' => $totalMapel,
            'rataRata' => $rataRata,
            'mataPelajaranBelumDiisi' => $mataPelajaranBelumDiisi,
        ]);
    }

    public function edit(Nilai $nilai)
    {
        $this->authorizeNilai($nilai);

        $nilai->load('siswa', 'mataPelajaran');

        return view('guru.nilai.edit', compact('nilai'));
    }

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

    public function destroy(Nilai $nilai)
    {
        $this->authorizeNilai($nilai);

        $nilai->delete();

        return redirect()
            ->route('guru.nilai.index')
            ->with('success', 'Nilai siswa berhasil dihapus.');
    }

    private function authorizeNilai(Nilai $nilai): void
    {
        $mapelGuru = $this->mapelGuruList();

        abort_unless(
            $mapelGuru->contains('id', $nilai->id_mata_pelajaran),
            403,
            'Anda tidak memiliki akses ke data nilai ini.'
        );

        abort_unless(
            $this->kelasGuru()->contains($nilai->siswa?->kelas),
            403,
            'Anda tidak memiliki akses ke siswa ini.'
        );
    }
}
?>
