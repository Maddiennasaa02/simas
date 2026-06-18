<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Guru;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index(Request $request)
    {
        $query = MataPelajaran::with('guru');

        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%')
                  ->orWhere('kode', 'like', '%' . $request->cari . '%');
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $mapel       = $query->orderBy('tingkat')->orderBy('nama')->paginate(15)->withQueryString();
        $totalMapel  = MataPelajaran::count();
        $mapelWajib  = MataPelajaran::where('jenis', 'wajib')->count();
        $muatanLokal = MataPelajaran::where('jenis', 'mulok')->count();
        $guruList    = Guru::with('user')->get();

        return view('admin.mata-pelajaran.index', compact(
            'mapel', 'totalMapel', 'mapelWajib', 'muatanLokal', 'guruList'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'    => 'required|string|max:20|unique:mata_pelajaran,kode',
            'nama'    => 'required|string|max:255',
            'jenis'   => 'required|in:wajib,mulok',
            'tingkat' => 'required|integer|min:1|max:6',
            'kkm'     => 'required|integer|min:0|max:100',
            'guru_id' => 'nullable|exists:guru,id',
            'status'  => 'required|in:aktif,tidak_aktif',
        ]);

        MataPelajaran::create($request->only([
            'kode', 'nama', 'jenis', 'tingkat', 'kkm', 'guru_id', 'status',
        ]));

        return redirect()->route('admin.mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function update(Request $request, MataPelajaran $mata_pelajaran)
    {
        $request->validate([
            'kode'    => 'required|string|max:20|unique:mata_pelajaran,kode,' . $mata_pelajaran->id,
            'nama'    => 'required|string|max:255',
            'jenis'   => 'required|in:wajib,mulok',
            'tingkat' => 'required|integer|min:1|max:6',
            'kkm'     => 'required|integer|min:0|max:100',
            'guru_id' => 'nullable|exists:guru,id',
            'status'  => 'required|in:aktif,tidak_aktif',
        ]);

        $mata_pelajaran->update($request->only([
            'kode', 'nama', 'jenis', 'tingkat', 'kkm', 'guru_id', 'status',
        ]));

        return redirect()->route('admin.mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy(MataPelajaran $mata_pelajaran)
    {
        $mata_pelajaran->delete();

        return redirect()->route('admin.mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}