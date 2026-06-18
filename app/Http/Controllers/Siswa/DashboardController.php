<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\{Absensi, Tugas, Materi, Nilai, Pengumuman, PengumpulanTugas};

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = auth()->user()->siswa;

        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan.');
        }

        // Tugas aktif yang belum dikumpulkan
        $tugasAktif = Tugas::where('kelas_id', $siswa->kelas_id)
            ->where('status', 'aktif')
            ->with('mataPelajaran')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($tugas) use ($siswa) {
                $tugas->sudah_kumpul = PengumpulanTugas::where('tugas_id', $tugas->id)
                    ->where('siswa_id', $siswa->id)
                    ->exists();
                return $tugas;
            });

        // Absensi bulan ini
        $absensi = Absensi::where('siswa_id', $siswa->id)
            ->whereMonth('tanggal', now()->month)
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        // Materi terbaru
        $materiTerbaru = Materi::whereHas('mataPelajaran', function ($q) use ($siswa) {
            $q->where('tingkat', $siswa->kelas?->tingkat ?? 0);
        })->with('mataPelajaran')->latest()->take(4)->get();

        // Pengumuman aktif
        $pengumuman = Pengumuman::where('status', 'aktif')
            ->whereIn('untuk', ['semua', 'siswa'])
            ->latest()->take(3)->get();

        // Nilai terbaru
        $nilai = Nilai::where('siswa_id', $siswa->id)
            ->with('mataPelajaran')
            ->latest()
            ->take(5)
            ->get();

        return view('siswa.dashboard', compact(
            'siswa', 'tugasAktif', 'absensi', 'materiTerbaru', 'pengumuman', 'nilai'
        ));
    }
}
