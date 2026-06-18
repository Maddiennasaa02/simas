<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanWaliController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengumuman::with('user')
            ->where('status', 'aktif')
            ->whereIn('untuk', ['semua', 'wali_murid']);

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $pengumuman   = $query->latest()->paginate(10)->withQueryString();
        $kategoriList = ['Akademik', 'Kegiatan', 'Libur', 'Kesehatan', 'Umum'];

        return view('wali.pengumuman.index', compact('pengumuman', 'kategoriList'));
    }

    public function show(Pengumuman $pengumuman)
    {
        // Pastikan pengumuman ini memang untuk wali/semua
        if (!in_array($pengumuman->untuk, ['semua', 'wali_murid'])) {
            abort(403);
        }
        return view('wali.pengumuman.show', compact('pengumuman'));
    }
}
