<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruKelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class GuruKelasController extends Controller
{
    /**
     * Halaman Verifikasi Guru (guruKelas/index.blade.php)
     * Menampilkan daftar guru + filter + pagination
     */
    public function index(Request $request)
    {
        $search  = $request->get('search');
        $status  = $request->get('status');
        $perPage = (int) $request->get('per_page', 10);

        // Query guru dengan filter
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

        // Statistik (dari seluruh guru, tanpa filter)
        $menunggu  = User::where('role', 'guru')->where('status', 'menunggu')->count();
        $disetujui = User::where('role', 'guru')->where('status', 'aktif')->count();
        $ditolak   = User::where('role', 'guru')->where('status', 'ditolak')->count();
        $totalGuru = User::where('role', 'guru')->count();

        $statistik = [
            'menunggu'    => $menunggu,
            'disetujui'   => $disetujui,
            'ditolak'     => $ditolak,
            'total_guru'  => $totalGuru,
        ];

        return view('admin.guruKelas.index', compact(
            'guru',
            'statistik',
            'search',
            'status'
        ));
    }

    /**
     * Halaman Kelola Penugasan Guru Kelas (guruKelas/daftarKelas.blade.php)
     * Menampilkan guru dengan relasi kelas & mata pelajaran
     */
    public function daftarKelas(Request $request)
    {
        $search      = $request->get('search');
        $guruId      = $request->get('guru_id');
        $statusFilter = $request->get('status');
        $perPage     = (int) $request->get('per_page', 10);

        $query = User::where('role', 'guru')
            ->with(['mataPelajaran:id,name,kode', 'kelas'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%")
                       ->orWhere('nip', 'like', "%{$search}%");
                });
            })
            ->when($guruId, function ($q) use ($guruId) {
                $q->where('id', $guruId);
            })
            ->when($statusFilter, function ($q) use ($statusFilter) {
                $q->where('status', $statusFilter);
            })
            ->orderBy('name');

        $guru = $query->paginate($perPage)->withQueryString();

        // Opsi dropdown filter guru
        $guruOptions = User::where('role', 'guru')->orderBy('name')->get(['id', 'name']);

        // Pilihan kelas dari tabel siswa
        $kelasOptions = Siswa::whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        // Pilihan mata pelajaran
        $mataPelajaranOptions = MataPelajaran::orderBy('name')->get(['id', 'name']);

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

    /**
     * Menampilkan guru-guru yang ditugaskan pada kelas tertentu
     */
    public function show(string $kelas)
    {
        $guruDiKelas = GuruKelas::with(['guru:id,name,nip,email'])
            ->where('kelas', $kelas)
            ->orderBy('id')
            ->get();

        return view('admin.guruKelas.show', compact('guruDiKelas', 'kelas'));
    }

    /**
     * Menambahkan guru ke kelas
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'kelas'   => 'required|string|max:30',
        ], [
            'id_user.required' => 'Guru wajib dipilih.',
            'id_user.exists'   => 'Guru tidak ditemukan.',
            'kelas.required'   => 'Kelas wajib dipilih.',
            'kelas.max'        => 'Nama kelas maksimal 30 karakter.',
        ]);

        $guru = User::where('id', $validated['id_user'])
            ->where('role', 'guru')
            ->first();

        if (!$guru) {
            return back()->withInput()->with('error', 'User yang dipilih bukan guru.');
        }

        $exists = GuruKelas::where('id_user', $validated['id_user'])
            ->where('kelas', $validated['kelas'])
            ->exists();

        if ($exists) {
            return back()->withInput()->with(
                'error',
                "Guru {$guru->name} sudah ditugaskan di kelas {$validated['kelas']}."
            );
        }

        GuruKelas::create([
            'id_user' => $validated['id_user'],
            'kelas'   => $validated['kelas'],
        ]);

        return redirect()
            ->route('admin.guruKelas.daftarKelas')
            ->with('success', "Guru {$guru->name} berhasil ditambahkan ke kelas {$validated['kelas']}.");
    }

    /**
     * Menghapus assignment guru dari kelas
     */
    public function destroy(GuruKelas $guruKelas)
    {
        $guruKelas->load('guru:id,name');
        $namaGuru = $guruKelas->guru->name ?? 'Guru';
        $kelas    = $guruKelas->kelas;

        $guruKelas->delete();

        return redirect()
            ->route('admin.guruKelas.daftarKelas')
            ->with('success', "Guru {$namaGuru} berhasil dihapus dari kelas {$kelas}.");
    }
}
