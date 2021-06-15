<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'no_agenda', 'indeks', 'masalah', 'tgl_pelaksana', 'jenis', 'instruksi', 'asal_surat', 'user_tujuan', 'nomor'
    ];

    public function tujuan_user()
    {
        return $this->belongsTo(User::class, 'user_tujuan', 'id');
    }


    public function teruskan()
    {
        return $this->hasMany(Teruskan::class, 'surat_id','id');
    }
}
