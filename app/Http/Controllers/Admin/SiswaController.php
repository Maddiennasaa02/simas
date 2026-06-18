<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Siswa, Kelas, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::with(['kelas', 'user']);

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->cari . '%')
                ->orWhere('nisn', 'like', '%' . $request->cari . '%');
            });
        }

        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $siswa     = $query->paginate(15)->withQueryString();
        $kelasList = Kelas::orderBy('tingkat')->get();

        return view('admin.siswa.index', compact('siswa', 'kelasList'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nisn'         => 'required|unique:siswa',
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin'=> 'required|in:L,P',
            'tanggal_lahir'=> 'required|date',
            'tempat_lahir' => 'required|string',
            'alamat'       => 'required|string',
            'kelas_id'     => 'nullable|exists:kelas,id',
            'email'        => 'required|email|unique:users',
            'password'     => 'required|min:6',
        ]);

        $user = User::create([
            'name'     => $validated['nama_lengkap'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'siswa',
        ]);

        Siswa::create([...$validated, 'user_id' => $user->id]);

        return redirect()->route('admin.siswa.index')
                        ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'kelas_id'     => 'nullable|exists:kelas,id',
        ]);
        $siswa->update($validated);
        return redirect()->route('admin.siswa.index')->with('success', 'Data diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->user?->delete();
        $siswa->delete();
        return redirect()->route('admin.siswa.index')->with('success', 'Data dihapus.');
    }
}