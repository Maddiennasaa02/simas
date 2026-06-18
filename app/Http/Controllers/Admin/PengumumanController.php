<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengumuman::with('user')->latest();

        if ($request->filled('cari')) {
            $query->where('judul', 'like', '%' . $request->cari . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('untuk')) {
            $query->where('untuk', $request->untuk);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Tab filter
        $tab = $request->get('tab', 'semua');
        if ($tab !== 'semua') {
            $query->where('status', $tab);
        }

        $pengumuman  = $query->paginate(10)->withQueryString();
        $total       = Pengumuman::count();
        $totalAktif  = Pengumuman::where('status', 'aktif')->count();
        $totalDraft  = Pengumuman::where('status', 'draft')->count();
        $totalArsip  = Pengumuman::where('status', 'arsip')->count();

        $kategoriList = ['Akademik', 'Kegiatan', 'Libur', 'Kesehatan', 'Umum'];

        return view('admin.pengumuman.index', compact(
            'pengumuman', 'total', 'totalAktif', 'totalDraft', 'totalArsip', 'kategoriList', 'tab'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'isi'      => 'required|string',
            'untuk'    => 'required|in:semua,guru,siswa,wali_murid',
            'kategori' => 'nullable|string|max:50',
            'status'   => 'required|in:aktif,draft,arsip',
        ]);

        Pengumuman::create([
            ...$request->only(['judul', 'isi', 'untuk', 'kategori', 'status']),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'isi'      => 'required|string',
            'untuk'    => 'required|in:semua,guru,siswa,wali_murid',
            'kategori' => 'nullable|string|max:50',
            'status'   => 'required|in:aktif,draft,arsip',
        ]);

        $pengumuman->update($request->only(['judul', 'isi', 'untuk', 'kategori', 'status']));

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}