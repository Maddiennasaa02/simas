<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['user_id','nisn','nama_lengkap','jenis_kelamin',
        'tanggal_lahir','tempat_lahir','alamat','kelas_id','wali_murid_id','foto'];

    public function user() { return $this->belongsTo(User::class); }
    public function kelas() { return $this->belongsTo(Kelas::class); }
    public function waliMurid() { return $this->belongsTo(User::class, 'wali_murid_id'); }
    public function nilai() { return $this->hasMany(Nilai::class); }
    public function absensi() { return $this->hasMany(Absensi::class); }
}