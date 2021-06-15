<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teruskan extends Model
{
    protected $fillable = [
        'surat_id', 'user_id', 'read'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id', 'id');
    }
}
