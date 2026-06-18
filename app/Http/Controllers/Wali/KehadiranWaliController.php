<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use App\Models\{Absensi, Siswa};
use Illuminate\Http\Request;

class KehadiranWaliController extends Controller
{
    public function index(Request $request)
    {
        $user     = auth()->user();
        $anakList = Siswa::where('wali_murid_id', $user->id)->with('kelas')->get();

        // Pilih anak yang sedang dilihat
        $anakId = $request->anak_id ?? $anakList->first()?->id;
        $anak   = $anakList->firstWhere('id', $anakId);

        if (!$anak) {
            return view('wali.kehadiran.index', [
                'anakList'      => $anakList,
                'anak'          => null,
                'absensi'       => collect(),
                'rekap'         => [],
                'bulan'         => now()->month,
                'tahun'         => now()->year,
            ]);
        }

        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $absensi = Absensi::where('siswa_id', $anak->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal')
            ->get();

        $rekap = [
            'hadir'      => $absensi->where('status', 'hadir')->count(),
            'sakit'      => $absensi->where('status', 'sakit')->count(),
            'izin'       => $absensi->where('status', 'izin')->count(),
            'alpha'      => $absensi->where('status', 'alpha')->count(),
            'total'      => $absensi->count(),
        ];
        $rekap['persentase'] = $rekap['total'] > 0
            ? round(($rekap['hadir'] / $rekap['total']) * 100, 1)
            : 0;

        return view('wali.kehadiran.index', compact(
            'anakList', 'anak', 'absensi', 'rekap', 'bulan', 'tahun'
        ));
    }
}
