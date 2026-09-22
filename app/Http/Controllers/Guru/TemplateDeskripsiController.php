<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\TemplateDeskripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TemplateDeskripsiController extends Controller
{
    private function mapelGuruList()
    {
        return Auth::user()->mataPelajaran;
    }

    private function kelasGuruList()
    {
        return Auth::user()
            ->kelas()
            ->pluck('kelas');
    }

    public function index()
    {
        $templates = TemplateDeskripsi::with('mataPelajaran')
            ->where('id_user', Auth::id())
            ->orderBy('id_mata_pelajaran')
            ->orderBy('predikat')
            ->get();

        return view('guru.template_deskripsi.index', compact('templates'));
    }

    public function create(Request $request)
    {
        $daftarMapel = $this->mapelGuruList();
        $kelasGuru = $this->kelasGuruList();

        // Hanya untuk tampilan/konteks form, TIDAK disimpan ke database.
        $kelasTerpilih = $request->input('kelas');

        return view('guru.template_deskripsi.create', compact(
            'daftarMapel',
            'kelasGuru',
            'kelasTerpilih'
        ));
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        $data['id_user'] = Auth::id();

        TemplateDeskripsi::create($data);

        return redirect()
            ->route('guru.template-deskripsi.index')
            ->with('success', 'Template deskripsi berhasil ditambahkan.');
    }

    public function edit(TemplateDeskripsi $template_deskripsi)
    {
        $this->authorizeTemplate($template_deskripsi);

        $daftarMapel = $this->mapelGuruList();
        $kelasGuru = $this->kelasGuruList();
        $kelasTerpilih = null;

        return view('guru.template_deskripsi.edit', [
            'template' => $template_deskripsi,
            'daftarMapel' => $daftarMapel,
            'kelasGuru' => $kelasGuru,
            'kelasTerpilih' => $kelasTerpilih,
        ]);
    }

    public function update(Request $request, TemplateDeskripsi $template_deskripsi)
    {
        $this->authorizeTemplate($template_deskripsi);

        $data = $this->validasi($request);
        $template_deskripsi->update($data);

        return redirect()
            ->route('guru.template-deskripsi.index')
            ->with('success', 'Template deskripsi berhasil diperbarui.');
    }

    public function destroy(TemplateDeskripsi $template_deskripsi)
    {
        $this->authorizeTemplate($template_deskripsi);
        $template_deskripsi->delete();

        return redirect()
            ->route('guru.template-deskripsi.index')
            ->with('success', 'Template deskripsi berhasil dihapus.');
    }

    public function getTemplate(Request $request)
    {
        $request->validate([
            'id_mata_pelajaran' => 'required|integer',
            'predikat' => ['required', 'string', Rule::in(['A', 'B', 'C', 'D'])],
        ]);

        abort_unless(
            $this->mapelGuruList()->contains('id', $request->id_mata_pelajaran),
            403,
            'Anda tidak mengampu mata pelajaran ini.'
        );

        $templates = TemplateDeskripsi::where('id_user', Auth::id())
            ->where('id_mata_pelajaran', $request->id_mata_pelajaran)
            ->where('predikat', $request->predikat)
            ->get(['id', 'nama_template', 'deskripsi']);

        return response()->json([
            'templates' => $templates,
        ]);
    }

    private function authorizeTemplate(TemplateDeskripsi $template): void
    {
        abort_if(
            $template->id_user !== Auth::id(),
            403,
            'Anda tidak memiliki akses ke template ini.'
        );
    }

    private function validasi(Request $request): array
    {
        $daftarMapelId = $this->mapelGuruList()->pluck('id')->toArray();

        return $request->validate([
            'id_mata_pelajaran' => [
                'required',
                Rule::in($daftarMapelId),
            ],
            'predikat' => ['required', 'string', Rule::in(['A', 'B', 'C', 'D'])],
            'nama_template' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string'],
        ], [
            'id_mata_pelajaran.required' => 'Mata pelajaran wajib dipilih.',
            'id_mata_pelajaran.in' => 'Anda tidak mengampu mata pelajaran ini.',
            'predikat.required' => 'Predikat wajib dipilih.',
            'nama_template.required' => 'Nama template wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
        ]);
    }
}
