<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komite extends Model
{
    protected $fillable = ['nama', 'jabatan', 'unsur', 'telepon', 'urutan', 'aktif'];

    protected $casts = ['aktif' => 'boolean'];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }
}