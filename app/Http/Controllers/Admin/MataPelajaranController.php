<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class MataPelajaranController extends Controller
{
    /**
     * Menampilkan semua mata pelajaran.
     */
    public function index(Request $request): View
{
    $search = $request->get('search');
    $kodeTerpilih = $request->get('kode');
    $perPage = (int) $request->get('per_page', 10);

    // Daftar kode untuk filter
    $daftarKode = MataPelajaran::query()
        ->select('kode')
        ->whereNotNull('kode')
        ->where('kode', '!=', '')
        ->distinct()
        ->orderBy('kode')
        ->pluck('kode');

    // Data mata pelajaran
    $mataPelajarans = MataPelajaran::query()
        ->withCount('gurus')

        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('kode', 'like', "%{$search}%");
            });
        })

        // Filter berdasarkan kode
        ->when($kodeTerpilih, function ($query) use ($kodeTerpilih) {
            $query->where('kode', $kodeTerpilih);
        })

        ->latest()
        ->paginate($perPage)
        ->appends($request->query());

    // Statistik keseluruhan
    $totalMapel = MataPelajaran::count();

    // Jumlah guru unik yang mengampu minimal 1 mapel
    $totalGuruPengampu = DB::table('guru_mapel')
        ->distinct('id_user')
        ->count('id_user');

    return view('admin.mapel.index', compact(
        'mataPelajarans',
        'search',
        'kodeTerpilih',
        'daftarKode',
        'totalMapel',
        'totalGuruPengampu'
    ));
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
            'name' => ['required', 'string', 'max:255', 'unique:mata_pelajarans,name'],
            'kode' => ['required', 'string', 'max:255', 'unique:mata_pelajarans,kode'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'name.required' => 'Nama mata pelajaran wajib diisi.',
            'name.unique' => 'Nama mata pelajaran sudah terdaftar.',
            'kode.required' => 'Kode mata pelajaran wajib diisi.',
            'kode.unique' => 'Kode mata pelajaran sudah terdaftar.',
        ]);

        MataPelajaran::create($validated);

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit mata pelajaran.
     */
    public function edit(MataPelajaran $mataPelajaran): View
    {
        return view('admin.mapel.edit', compact('mataPelajaran'));
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
            'kode' => [
                'required',
                'string',
                'max:255',
                Rule::unique('mata_pelajarans', 'kode')
                    ->ignore($mataPelajaran->id),
            ],
            'keterangan' => ['nullable', 'string'],
        ], [
            'name.required' => 'Nama mata pelajaran wajib diisi.',
            'name.unique' => 'Nama mata pelajaran sudah terdaftar.',
            'kode.required' => 'Kode mata pelajaran wajib diisi.',
            'kode.unique' => 'Kode mata pelajaran sudah terdaftar.',
        ]);

        $mataPelajaran->update($validated);

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    /**
     * Menghapus mata pelajaran.
     */
    public function destroy(
        MataPelajaran $mataPelajaran
    ): RedirectResponse {
        $mataPelajaran->delete();

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
