<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $guarded = ['id_arsip'];
    protected $table = 'arsip';
    protected $primaryKey = 'id_arsip';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function klasifikasi()
    {
        return $this->belongsTo(KlasifikasiArsip::class, 'klasifikasi_id');
    }

    public function lemari()
    {
        return $this->belongsTo(Lemari::class, 'lemari_id');
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class, 'rak_id');
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }
}
