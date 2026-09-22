<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $allGuru = User::where('role', 'guru')
            ->with('mataPelajaran')
            ->get();

        $totalGuru = $allGuru->count();
        $guruAktif = $allGuru->where('status', 'aktif')->count();
        $guruNonAktif = $totalGuru - $guruAktif;

        $totalRelasiMapel = $allGuru->sum(
            fn ($g) => $g->mataPelajaran->count()
        );

        $statistik = [
            'total_guru' => $totalGuru,
            'guru_aktif' => $guruAktif,
            'persentase_aktif' => $totalGuru > 0
                ? round(($guruAktif / $totalGuru) * 100, 1)
                : 0,
            'guru_non_aktif' => $guruNonAktif,
            'persentase_non_aktif' => $totalGuru > 0
                ? round(($guruNonAktif / $totalGuru) * 100, 1)
                : 0,
            'rata_rata_mapel' => $totalGuru > 0
                ? round($totalRelasiMapel / $totalGuru, 1)
                : 0,
        ];

        $waitingTeacher = $allGuru
            ->where('status', 'menunggu')
            ->count();

        // Hanya guru aktif yang tampil di Kelola Guru
        $query = User::where('role', 'guru')
            ->where('status', 'aktif')
            ->with([
                'mataPelajaran:id,name,kode',
                'kelas'
            ]);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('mata_pelajaran')) {
            $mapelId = $request->mata_pelajaran;

            $query->whereHas('mataPelajaran', function ($q) use ($mapelId) {
                $q->where('mata_pelajarans.id', $mapelId);
            });
        }

        if ($request->filled('kelas')) {
            $kelas = $request->kelas;

            $query->whereHas('kelas', function ($q) use ($kelas) {
                $q->where('kelas', $kelas);
            });
        }

        $guru = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $mataPelajaranOptions = MataPelajaran::orderBy('name')
            ->get(['id', 'name']);

        $kelasOptions = $allGuru
            ->flatMap(fn ($g) => $g->kelas->pluck('kelas'))
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('admin.guru.index', compact(
            'guru',
            'waitingTeacher',
            'statistik',
            'mataPelajaranOptions',
            'kelasOptions'
        ));
    }

    public function create()
    {
        $mataPelajaran = MataPelajaran::orderBy('name')->get();

        return view(
            'admin.guru.create',
            compact('mataPelajaran')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'nip' => 'required|string|unique:users,nip',
            'id_mata_pelajaran' => 'required|exists:mata_pelajarans,id',
        ]);

        $guru = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'role' => 'guru',
            'status' => 'menunggu',
        ]);

        $guru->mataPelajaran()->attach(
            $request->id_mata_pelajaran
        );

        $guru->load('mataPelajaran:id,name,kode');

        return redirect()
            ->route('admin.guru.index')
            ->with(
                'sukses',
                "Guru {$guru->name} berhasil ditambahkan."
            );
    }

    public function show(User $guru)
{
    abort_if($guru->role !== 'guru', 404);

    $guru->load([
        'mataPelajaran:id,name,kode',
        'kelas'
    ]);

    $totalMataPelajaran = $guru->mataPelajaran->count();

    $totalKelas = $guru->kelas->count();

    return view('admin.guru.show', compact(
        'guru',
        'totalMataPelajaran',
        'totalKelas'
    ));
}

    public function edit(User $guru)
    {
        abort_if($guru->role !== 'guru', 404);

        $guru->load('mataPelajaran');

        $mataPelajaran = MataPelajaran::orderBy('name')
            ->get();

        return view(
            'admin.guru.edit',
            compact('guru', 'mataPelajaran')
        );
    }

    public function update(Request $request, User $guru)
    {
        abort_if($guru->role !== 'guru', 404);

        $request->validate([
            'name' => 'required|string|max:225',
            'email' => 'nullable|email|unique:users,email,' . $guru->id,
            'password' => 'nullable|string|min:6|confirmed',
            'nip' => 'required|string|unique:users,nip,' . $guru->id,
            'id_mata_pelajaran' => 'nullable|exists:mata_pelajarans,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make(
                $request->password
            );
        }

        $guru->update($data);

        if ($request->filled('id_mata_pelajaran')) {
            $guru->mataPelajaran()->sync([
                $request->id_mata_pelajaran
            ]);
        }

        $guru->load([
            'mataPelajaran:id,name,kode',
            'kelas'
        ]);

        return redirect()
            ->route('admin.guru.index')
            ->with(
                'sukses',
                "Data guru {$guru->name} berhasil diperbarui."
            );
    }

    public function destroy(User $guru)
    {
        abort_if($guru->role !== 'guru', 404);

        $nama = $guru->name;

        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with(
                'sukses',
                "Akun guru {$nama} berhasil dihapus."
            );
    }

    public function confirmation(User $guru)
    {
        abort_if($guru->role !== 'guru', 404);

        $guru->update([
            'status' => 'aktif'
        ]);

        return redirect()
            ->route('admin.guru.index')
            ->with(
                'sukses',
                "Akun guru {$guru->name} telah dikonfirmasi. Guru sekarang dapat login."
            );
    }

    public function rejected(User $guru)
    {
        abort_if($guru->role !== 'guru', 404);

        $guru->update([
            'status' => 'ditolak'
        ]);

        return redirect()
            ->route('admin.guru.index')
            ->with(
                'sukses',
                "Akun guru {$guru->name} telah ditolak."
            );
    }

    public function mataPelajaran()
    {
        $mapel = MataPelajaran::orderBy('name')
            ->get(['id', 'name', 'kode']);

        return response()->json([
            'status' => 'success',
            'data' => $mapel,
        ]);
    }
}