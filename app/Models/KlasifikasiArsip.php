<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KlasifikasiArsip extends Model
{

    protected $guarded = ['id_klasifikasi_arsip'];
    protected $table = 'klasifikasi_arsip';
    protected $primaryKey = 'id_klasifikasi_arsip';


    public function daftarArsip()
    {
        return $this->belongsTo(DaftarArsip::class, 'daftar_arsip_id');
    }

    public function arsips()
    {
        return $this->hasMany(Arsip::class, 'klasifikasi_id');
    }
}
