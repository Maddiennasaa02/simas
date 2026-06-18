<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use App\Models\{Tugas, PengumpulanTugas, Siswa, Absensi};
use Illuminate\Http\Request;

class TugasWaliController extends Controller
{
    public function index(Request $request)
    {
        $user     = auth()->user();
        $anakList = Siswa::where('wali_murid_id', $user->id)->with('kelas')->get();

        $anakId = $request->anak_id ?? $anakList->first()?->id;
        $anak   = $anakList->firstWhere('id', $anakId);

        if (!$anak) {
            return view('wali.tugas.index', [
                'anakList'    => $anakList,
                'anak'        => null,
                'tugas'       => collect(),
                'pengumpulan' => collect(),
            ]);
        }

        $tugas = Tugas::where('kelas_id', $anak->kelas_id)
            ->where('status', '!=', 'draft')
            ->with(['mataPelajaran', 'guru.user'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $pengumpulan = PengumpulanTugas::where('siswa_id', $anak->id)
            ->pluck('status', 'tugas_id');

        $nilai = PengumpulanTugas::where('siswa_id', $anak->id)
            ->whereNotNull('nilai')
            ->pluck('nilai', 'tugas_id');

        return view('wali.tugas.index', compact(
            'anakList', 'anak', 'tugas', 'pengumpulan', 'nilai'
        ));
    }
}
