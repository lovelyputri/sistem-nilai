<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = User::where('role', 'guru')
            ->with('mataPelajaran:id,name,kode', 'kelas')
            ->orderBy('name')
            ->get();

        $waitingTeacher = $guru->where('status', 'menunggu')->count();

        $data = $guru->map(fn($g) => [
            'id' => $g->id,
            'name' => $g->name,
            'email' => $g->email,
            'nip' => $g->nip,
            'status' => $g->status,
            'mata_pelajaran' => $g->mataPelajaran,
            'kelas' => $g->kelas->pluck('kelas'),
        ]);

        // --- Statistik untuk 4 kartu di atas ---
        $totalGuru        = $guru->count();
        $guruAktif        = $guru->where('status', 'aktif')->count();
        $guruNonAktif     = $totalGuru - $guruAktif; // gabungan status 'menunggu' & 'ditolak'
        $totalRelasiMapel = $guru->sum(fn ($g) => $g->mataPelajaran->count());

        $statistik = [
            'total_guru'           => $totalGuru,
            'guru_aktif'           => $guruAktif,
            'persentase_aktif'     => $totalGuru > 0 ? round(($guruAktif / $totalGuru) * 100, 1) : 0,
            'guru_non_aktif'       => $guruNonAktif,
            'persentase_non_aktif' => $totalGuru > 0 ? round(($guruNonAktif / $totalGuru) * 100, 1) : 0,
            'rata_rata_mapel'      => $totalGuru > 0 ? round($totalRelasiMapel / $totalGuru, 1) : 0,
        ];

        // --- Opsi filter dropdown (diambil dari data asli, bukan hardcode) ---
        $mataPelajaranOptions = MataPelajaran::orderBy('name')->get(['id', 'name']);

        $kelasOptions = $guru->flatMap(fn ($g) => $g->kelas->pluck('kelas'))
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('admin.guru.index', compact(
            'guru',
            'waitingTeacher',
            'data',
            'statistik',
            'mataPelajaranOptions',
            'kelasOptions'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mataPelajaran = MataPelajaran::orderBy('name')->get();
        return view('admin.guru.create', compact('mataPelajaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:225",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:6|confirmed",
            "nip" => "required|string|unique:users,nip",
            "id_mata_pelajaran" => "required|exists:mata_pelajarans,id",
        ]);

        $guru = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "nip" => $request->nip,
            "password" => Hash::make($request->password),
            "role" => "guru",
            "status" => "menunggu",
        ]);

        $guru->mataPelajaran()->attach($request->id_mata_pelajaran);
        $guru->load("mataPelajaran:id,name,kode");

        return redirect()
            ->route("admin.guru.index")
            ->with("sukses", "Guru {$guru->name} berhasil ditambahkan.");

        // return response()->json([
        //     "status" => "success",
        //     "message" => "Guru {$guru->name} berhasil ditambahkan.",
        //     "data" => $guru,
        // ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $guru)
    {
        abort_if($guru->role !== "guru", 404);

        $guru->load("mataPelajaran");
        $mataPelajaran = MataPelajaran::orderBy("name")->get();

        return view("admin.guru.edit", compact("guru", "mataPelajaran"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $guru)
    {
        abort_if($guru->role != 'guru', 404);

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
            $data['password'] = Hash::make($request->password);
        }

        $guru->update($data);

        if ($request->filled('id_mata_pelajaran')) {
            $guru->mataPelajaran()->sync([$request->id_mata_pelajaran]);
        }

        $guru->load('mataPelajaran:id,name,kode', 'kelas');

        return redirect()
            ->route('admin.guru.index')
            ->with('sukses', "Data guru {$guru->name} berhasil diperbarui.");

        // return response()->json([
        //     'status' => 'success',
        //     'message' => "Data guru {$guru->name} berhasil diperbarui.",
        //     'data' => $guru,
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $guru)
    {
        abort_if($guru->role != 'guru', 404);

        $nama = $guru->name;
        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with('sukses', "Akun guru {$nama} berhasil dihapus");

        // return response()->json([
        //     'status' => 'success',
        //     'message' => "Akun guru {$nama} berhasil dihapus.",
        // ]);
    }

    /**
     * Confirm teacher account.
     */
    public function confirmation(User $guru)
    {
        abort_if($guru->role != "guru", 404);

        $guru->update(['status' => 'aktif']);

        return redirect()
            ->route('admin.guru.index')
            ->with('sukses', "Akun guru {$guru->name} telah dikonfirmasi. Guru sekarang dapat login");

        // return response()->json([
        //     'status' => 'success',
        //     'message' => "Akun guru {$guru->name} telah dikonfirmasi.",
        // ]);
    }

    /**
     * Reject teacher account.
     */
    public function rejected(User $guru)
    {
        abort_if($guru->role != "guru", 404);

        $guru->update(['status' => 'ditolak']);

        return redirect()
            ->route('admin.guru.index')
            ->with('sukses', "Akun guru {$guru->name} telah ditolak");

        // return response()->json([
        //     'status' => 'success',
        //     'message' => "Akun guru {$guru->name} telah ditolak.",
        // ]);
    }

    /**
     * Helper: daftar mata pelajaran
     */
    public function mataPelajaran()
    {
        $mapel = MataPelajaran::orderBy('name')->get(['id', 'name', 'kode']);

        return response()->json([
            "status" => "success",
            "data" => $mapel,
        ]);
    }
}
