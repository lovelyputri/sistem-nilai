<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MataPelajaranController extends Controller
{
    /**
     * Menampilkan semua mata pelajaran.
     */
    public function index(Request $request): View
    {
        $search = trim($request->input('search', ''));
        $kodeTerpilih = $request->input('kode');

        $perPage = (int) $request->input('per_page', 10);

        if (!in_array($perPage, [10, 25, 50], true)) {
            $perPage = 10;
        }

        $daftarKode = MataPelajaran::query()
            ->whereNotNull('kode')
            ->where('kode', '!=', '')
            ->distinct()
            ->orderBy('kode')
            ->pluck('kode');

        $mataPelajarans = MataPelajaran::query()
            ->withCount('gurus')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('kode', 'like', "%{$search}%");
                });
            })
            ->when($kodeTerpilih, function ($query) use ($kodeTerpilih) {
                $query->where('kode', $kodeTerpilih);
            })
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        $totalMapel = MataPelajaran::count();

        $totalGuruPengampu = DB::table('guru_mapel')
            ->whereNotNull('id_user')
            ->distinct()
            ->count('id_user');

        return view('admin.mapel.index', [
            'mataPelajarans' => $mataPelajarans,
            'search' => $search,
            'kodeTerpilih' => $kodeTerpilih,
            'daftarKode' => $daftarKode,
            'totalMapel' => $totalMapel,
            'totalGuruPengampu' => $totalGuruPengampu,
        ]);
    }

    /**
     * Menampilkan detail mata pelajaran.
     */
    public function show(MataPelajaran $mataPelajaran): View
    {
        $mataPelajaran->load('gurus');

        return view('admin.mapel.show', [
            'mataPelajaran' => $mataPelajaran,
        ]);
    }

    /**
     * Menampilkan form tambah mata pelajaran.
     */
    public function create(): View
    {
        return view('admin.mapel.create');
    }

    /**
     * Menyimpan mata pelajaran baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:mata_pelajarans,name',
            ],
        ], [
            'name.required' => 'Nama mata pelajaran wajib diisi.',
            'name.string' => 'Nama mata pelajaran harus berupa teks.',
            'name.max' => 'Nama mata pelajaran maksimal 255 karakter.',
            'name.unique' => 'Nama mata pelajaran sudah terdaftar.',
        ]);

        $nama = trim($validated['name']);

        $kode = $this->generateKode($nama);

        $keterangan = 'Mata Pelajaran ' . $nama;

        MataPelajaran::create([
            'name' => $nama,
            'kode' => $kode,
            'keterangan' => $keterangan,
        ]);

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit mata pelajaran.
     */
    public function edit(MataPelajaran $mataPelajaran): View
    {
        return view('admin.mapel.edit', [
            'mataPelajaran' => $mataPelajaran,
        ]);
    }

    /**
     * Mengupdate mata pelajaran.
     */
    public function update(
        Request $request,
        MataPelajaran $mataPelajaran
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('mata_pelajarans', 'name')
                    ->ignore($mataPelajaran->id),
            ],
        ], [
            'name.required' => 'Nama mata pelajaran wajib diisi.',
            'name.string' => 'Nama mata pelajaran harus berupa teks.',
            'name.max' => 'Nama mata pelajaran maksimal 255 karakter.',
            'name.unique' => 'Nama mata pelajaran sudah terdaftar.',
        ]);

        $nama = trim($validated['name']);

        $kode = $this->generateKode(
            $nama,
            $mataPelajaran->id
        );

        $keterangan = 'Mata Pelajaran ' . $nama;

        $mataPelajaran->update([
            'name' => $nama,
            'kode' => $kode,
            'keterangan' => $keterangan,
        ]);

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    /**
     * Menghapus mata pelajaran.
     */
    public function destroy(MataPelajaran $mataPelajaran): RedirectResponse
    {
        $mataPelajaran->delete();

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }

    /**
     * Membuat kode otomatis.
     */
    private function generateKode(string $nama, ?int $ignoreId = null): string
    {
        $kata = preg_split('/\s+/', trim($nama));

        if (count($kata) >= 2) {
            $kode = strtoupper(
                Str::substr($kata[0], 0, 1) .
                Str::substr($kata[1], 0, 2)
            );
        } else {
            $namaBersih = preg_replace('/[^A-Za-z]/', '', $nama);

            $kode = strtoupper(
                Str::substr($namaBersih, 0, 3)
            );
        }

        if ($kode === '') {
            $kode = 'MAP';
        }

        $kodeAwal = $kode;
        $nomor = 1;

        while (true) {
            $query = MataPelajaran::query()
                ->where('kode', $kode);

            if ($ignoreId !== null) {
                $query->where('id', '!=', $ignoreId);
            }

            if (!$query->exists()) {
                break;
            }

            $kode = $kodeAwal . $nomor;
            $nomor++;
        }

        return $kode;
    }
}