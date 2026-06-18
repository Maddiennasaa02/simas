<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'forum';

    protected $fillable = [
        'judul',
        'isi',
        'user_id',
        'kelas_id',
        'untuk',
        'is_pinned',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function komentar()
    {
        return $this->hasMany(ForumKomentar::class, 'forum_id')->orderBy('created_at');
    }
}
