<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumKomentar extends Model
{
    protected $table = 'forum_komentar';

    protected $fillable = [
        'forum_id',
        'user_id',
        'isi',
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
