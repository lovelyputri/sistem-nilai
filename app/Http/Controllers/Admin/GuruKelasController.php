<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruKelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruKelasController extends Controller
{
    /**
     * Halaman Verifikasi Guru
     * Menampilkan semua guru + filter + pagination
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $perPage = (int) $request->get('per_page', 10);

        // Semua guru tetap ditampilkan di halaman verifikasi
        $query = User::where('role', 'guru')
            ->with(['mataPelajaran:id,name,kode'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%")
                        ->orWhere('nip', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->latest();

        $guru = $query->paginate($perPage)->withQueryString();

        // Statistik semua guru
        $menunggu = User::where('role', 'guru')
            ->where('status', 'menunggu')
            ->count();

        $disetujui = User::where('role', 'guru')
            ->where('status', 'aktif')
            ->count();

        $ditolak = User::where('role', 'guru')
            ->where('status', 'ditolak')
            ->count();

        $totalGuru = User::where('role', 'guru')->count();

        $statistik = [
            'menunggu' => $menunggu,
            'disetujui' => $disetujui,
            'ditolak' => $ditolak,
            'total_guru' => $totalGuru,
        ];

        return view('admin.guruKelas.index', compact(
            'guru',
            'statistik',
            'search',
            'status'
        ));
    }

    /**
     * Halaman Kelola Penugasan Guru Kelas
     *
     * HANYA GURU AKTIF YANG DITAMPILKAN
     */
    public function daftarKelas(Request $request)
    {
        $search = $request->get('search');
        $guruId = $request->get('guru_id');
        $statusFilter = $request->get('status');
        $perPage = (int) $request->get('per_page', 10);

        $query = User::where('role', 'guru')
            ->where('status', 'aktif')
            ->with([
                'mataPelajaran:id,name,kode',
                'kelas'
            ])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%")
                        ->orWhere('nip', 'like', "%{$search}%");
                });
            })
            ->when($guruId, function ($q) use ($guruId) {
                $q->where('id', $guruId);
            })
            ->orderBy('name');

        $guru = $query->paginate($perPage)->withQueryString();

        $guruOptions = User::where('role', 'guru')
            ->where('status', 'aktif')
            ->orderBy('name')
            ->get(['id', 'name']);

        $kelasOptions = Siswa::whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        $mataPelajaranOptions = MataPelajaran::orderBy('name')
            ->get(['id', 'name']);

        return view('admin.guruKelas.daftarKelas', compact(
            'guru',
            'guruOptions',
            'kelasOptions',
            'mataPelajaranOptions',
            'search',
            'guruId',
            'statusFilter'
        ));
    }

    public function tambahPenugasan()
{
    // Ambil guru aktif beserta mata pelajaran yang dimilikinya
    $guru = User::where('role', 'guru')
        ->where('status', 'aktif')
        ->with('mataPelajaran:id,name,kode')
        ->orderBy('name')
        ->get();

    // Ambil semua kelas dari data siswa
    $kelas = Siswa::whereNotNull('kelas')
        ->where('kelas', '!=', '')
        ->distinct()
        ->orderBy('kelas')
        ->pluck('kelas');

    return view('admin.guruKelas.tambahPenugasan', compact(
        'guru',
        'kelas'
    ));
}


    public function storePenugasan(Request $request)
    {
        $request->validate([
            'id_user' => ['required', 'exists:users,id'],

            'id_mata_pelajaran' => ['required', 'array', 'min:1'],
            'id_mata_pelajaran.*' => ['required', 'exists:mata_pelajarans,id'],

            'kelas' => ['required', 'string'],
        ], [
            'id_user.required' => 'Guru wajib dipilih.',
            'id_user.exists' => 'Guru yang dipilih tidak ditemukan.',

            'id_mata_pelajaran.required' => 'Minimal satu mata pelajaran wajib dipilih.',
            'id_mata_pelajaran.array' => 'Format mata pelajaran tidak valid.',
            'id_mata_pelajaran.min' => 'Minimal satu mata pelajaran wajib dipilih.',
            'id_mata_pelajaran.*.exists' => 'Mata pelajaran yang dipilih tidak ditemukan.',

            'kelas.required' => 'Kelas wajib dipilih.',
        ]);

        // Pastikan guru memang aktif dan role-nya guru
        $guru = User::where('id', $request->id_user)
            ->where('role', 'guru')
            ->where('status', 'aktif')
            ->first();

        if (!$guru) {
            return back()
                ->withInput()
                ->with('error', 'Guru yang dipilih tidak valid atau tidak aktif.');
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil semua mapel yang dipilih
        |--------------------------------------------------------------------------
        */
        $mapelIds = collect($request->id_mata_pelajaran)
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Pastikan semua mapel memang dimiliki guru
        |--------------------------------------------------------------------------
        */
        $jumlahMapelGuru = \DB::table('guru_mapel')
            ->where('id_user', $request->id_user)
            ->whereIn('id_mata_pelajaran', $mapelIds)
            ->count();

        if ($jumlahMapelGuru !== $mapelIds->count()) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ada mata pelajaran yang belum ditambahkan ke guru yang dipilih.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Cek apakah guru sudah ditugaskan ke kelas tersebut
        |--------------------------------------------------------------------------
        */
        $sudahAda = GuruKelas::where('id_user', $request->id_user)
            ->where('kelas', $request->kelas)
            ->exists();

        if ($sudahAda) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Guru ' . $guru->name .
                    ' sudah ditugaskan ke kelas ' .
                    $request->kelas . '.'
                );
        }

        try {

            /*
            |--------------------------------------------------------------------------
            | Simpan penugasan guru ke kelas
            |--------------------------------------------------------------------------
            |
            | Mata pelajaran TIDAK disimpan di guru_kelas.
            | Mapel guru sudah tersimpan di tabel guru_mapel.
            |
            */
            GuruKelas::create([
                'id_user' => $request->id_user,
                'kelas' => $request->kelas,
            ]);

        } catch (\Illuminate\Database\QueryException $e) {

            if (isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Guru tersebut sudah ditugaskan ke kelas ' .
                        $request->kelas . '.'
                    );
            }

            throw $e;
        }

        return redirect()
            ->route('admin.guruKelas.daftarKelas')
            ->with(
                'success',
                'Penugasan guru berhasil ditambahkan.'
            );
    }
    public function editPenugasan($id)
    {
        $penugasan = GuruKelas::findOrFail($id);

        $guru = User::where('role', 'guru')
            ->where('status', 'aktif')
            ->with('mataPelajaran:id,name,kode')
            ->orderBy('name')
            ->get();

        $kelas = Siswa::whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        return view('admin.guruKelas.editPenugasan', compact(
            'penugasan',
            'guru',
            'kelas'
        ));
    }


    public function updatePenugasan(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'kelas' => 'required|string',
        ]);

        $penugasan = GuruKelas::findOrFail($id);

        // Cek apakah guru + kelas sudah digunakan
        // kecuali data yang sedang diedit
        $sudahAda = GuruKelas::where('id_user', $request->id_user)
            ->where('kelas', $request->kelas)
            ->where('id', '!=', $penugasan->id)
            ->exists();

        if ($sudahAda) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Guru tersebut sudah mengajar di kelas ' . $request->kelas . '.'
                );
        }

        $penugasan->update([
            'id_user' => $request->id_user,
            'kelas' => $request->kelas,
        ]);

        return redirect()
            ->route('admin.guruKelas.daftarKelas')
            ->with(
                'success',
                'Penugasan guru berhasil diperbarui.'
            );
    }

    public function tambahMapel()
{
    $guru = User::where('role', 'guru')
        ->where('status', 'aktif')
        ->orderBy('name')
        ->get([
            'id',
            'name',
            'nip',
        ]);

    $mataPelajaran = MataPelajaran::orderBy('name')
        ->get([
            'id',
            'kode',
            'name',
        ]);

    // Ambil mapel yang sudah dimiliki setiap guru
    $guruMapel = DB::table('guru_mapel')
        ->select(
            'id_user',
            'id_mata_pelajaran'
        )
        ->get()
        ->groupBy('id_user')
        ->map(function ($items) {
            return $items
                ->pluck('id_mata_pelajaran')
                ->map(fn ($id) => (int) $id)
                ->values()
                ->toArray();
        });

    return view(
        'admin.guruKelas.tambahMapel',
        compact(
            'guru',
            'mataPelajaran',
            'guruMapel'
        )
    );
}


public function storeMapel(Request $request)
{
    $request->validate([
        'id_user' => [
            'required',
            'exists:users,id',
        ],

        'id_mata_pelajaran' => [
            'required',
            'array',
            'min:1',
        ],

        'id_mata_pelajaran.*' => [
            'required',
            'exists:mata_pelajarans,id',
        ],
    ], [
        'id_user.required' =>
            'Guru wajib dipilih.',

        'id_user.exists' =>
            'Guru yang dipilih tidak ditemukan.',

        'id_mata_pelajaran.required' =>
            'Minimal satu mata pelajaran wajib dipilih.',

        'id_mata_pelajaran.array' =>
            'Format mata pelajaran tidak valid.',

        'id_mata_pelajaran.min' =>
            'Minimal satu mata pelajaran wajib dipilih.',

        'id_mata_pelajaran.*.exists' =>
            'Mata pelajaran yang dipilih tidak ditemukan.',
    ]);

    // Pastikan guru aktif
    $guru = User::where('id', $request->id_user)
        ->where('role', 'guru')
        ->where('status', 'aktif')
        ->first();

    if (!$guru) {
        return back()
            ->withInput()
            ->with(
                'error',
                'Guru yang dipilih tidak valid atau tidak aktif.'
            );
    }

    // Hilangkan duplikat mapel
    $mapelIds = collect($request->id_mata_pelajaran)
        ->map(fn ($id) => (int) $id)
        ->unique()
        ->values();

    // Cari mapel yang sudah dimiliki guru
    $mapelSudahAda = DB::table('guru_mapel')
        ->where('id_user', $request->id_user)
        ->whereIn(
            'id_mata_pelajaran',
            $mapelIds
        )
        ->pluck('id_mata_pelajaran')
        ->map(fn ($id) => (int) $id);

    // Jika ada mapel yang sudah terdaftar
    if ($mapelSudahAda->isNotEmpty()) {

        $namaMapelSudahAda = MataPelajaran::whereIn(
            'id',
            $mapelSudahAda
        )
            ->pluck('name')
            ->implode(', ');

        return back()
            ->withInput()
            ->with(
                'error',
                'Mata pelajaran ' .
                $namaMapelSudahAda .
                ' sudah dimiliki oleh guru ' .
                $guru->name .
                '.'
            );
    }

    // Simpan
    try {

        DB::transaction(function () use (
            $request,
            $mapelIds
        ) {

            foreach ($mapelIds as $mapelId) {

                DB::table('guru_mapel')->insert([
                    'id_user' => $request->id_user,
                    'id_mata_pelajaran' => $mapelId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

    } catch (\Illuminate\Database\QueryException $e) {

        if (
            isset($e->errorInfo[1]) &&
            $e->errorInfo[1] == 1062
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Salah satu mata pelajaran sudah dimiliki guru tersebut.'
                );
        }

        throw $e;
    }

    return redirect()
        ->route('admin.guruKelas.daftarKelas')
        ->with(
            'success',
            'Mata pelajaran berhasil ditambahkan ke guru ' .
            $guru->name .
            '.'
        );
}
    /**
     * Menampilkan guru-guru yang ditugaskan
     * pada kelas tertentu.
     */
    public function show(string $kelas)
    {
        $guruDiKelas = GuruKelas::with([
            'guru:id,name,nip,email'
        ])
            ->where('kelas', $kelas)
            ->orderBy('id')
            ->get();

        return view(
            'admin.guruKelas.show',
            compact('guruDiKelas', 'kelas')
        );
    }

    /**
     * Menambahkan guru ke kelas.
     *
     * Hanya guru aktif yang boleh ditugaskan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'kelas' => 'required|string|max:30',
        ], [
            'id_user.required' => 'Guru wajib dipilih.',
            'id_user.exists' => 'Guru tidak ditemukan.',
            'kelas.required' => 'Kelas wajib dipilih.',
            'kelas.max' => 'Nama kelas maksimal 30 karakter.',
        ]);

        $guru = User::where('id', $validated['id_user'])
            ->where('role', 'guru')
            ->first();

        if (!$guru) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'User yang dipilih bukan guru.'
                );
        }

        if ($guru->status !== 'aktif') {
            return back()
                ->withInput()
                ->with(
                    'error',
                    "Guru {$guru->name} tidak dapat ditugaskan karena statusnya bukan aktif."
                );
        }

        $exists = GuruKelas::where('id_user', $validated['id_user'])
            ->where('kelas', $validated['kelas'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    "Guru {$guru->name} sudah ditugaskan di kelas {$validated['kelas']}."
                );
        }

        GuruKelas::create([
            'id_user' => $validated['id_user'],
            'kelas' => $validated['kelas'],
        ]);

        return redirect()
            ->route('admin.guruKelas.daftarKelas')
            ->with(
                'success',
                "Guru {$guru->name} berhasil ditambahkan ke kelas {$validated['kelas']}."
            );
    }

    /**
     * Menghapus assignment guru dari kelas.
     */
    public function destroy(GuruKelas $guruKelas)
    {
        $guruKelas->load('guru:id,name');

        $namaGuru = $guruKelas->guru->name ?? 'Guru';
        $kelas = $guruKelas->kelas;

        $guruKelas->delete();

        return redirect()
            ->route('admin.guruKelas.daftarKelas')
            ->with(
                'success',
                "Guru {$namaGuru} berhasil dihapus dari kelas {$kelas}."
            );
    }
}