<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $siswa = auth()->user()->siswa;

        $query = Absensi::where('siswa_id', $siswa->id)->with('kelas');

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        } else {
            $query->whereMonth('tanggal', now()->month);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        } else {
            $query->whereYear('tanggal', now()->year);
        }

        $absensi = $query->orderBy('tanggal')->get();

        // Rekap per status
        $rekap = [
            'hadir' => $absensi->where('status', 'hadir')->count(),
            'sakit' => $absensi->where('status', 'sakit')->count(),
            'izin'  => $absensi->where('status', 'izin')->count(),
            'alpha' => $absensi->where('status', 'alpha')->count(),
        ];
        $rekap['total']      = $absensi->count();
        $rekap['persentase'] = $rekap['total'] > 0
            ? round(($rekap['hadir'] / $rekap['total']) * 100, 1)
            : 0;

        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        return view('siswa.absensi.index', compact('absensi', 'rekap', 'bulan', 'tahun', 'siswa'));
    }
}
