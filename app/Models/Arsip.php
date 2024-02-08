<?php

namespace App\Models;

use App\Models\Disposisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arsip extends Model
{
    use HasFactory;

    protected $guarded = ['id_arsip'];
    protected $table = 'arsip';
    protected $primaryKey = 'id_arsip';


    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'users_id');
    // }

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

    public function disposisi()
    {
        return $this->hasMany(Disposisi::class, 'arsip_id', 'id_arsip');
    }

    // many to many relationship
    public function users()
    {
        return $this->belongsToMany(User::class, 'arsip_user', 'arsip_id', 'user_id')
            ->withPivot('status', 'disposisi_keterangan');
    }
}
