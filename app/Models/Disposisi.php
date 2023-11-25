<?php

namespace App\Models;

use App\Models\User;
use App\Models\Arsip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disposisi extends Model
{
    use HasFactory;


    protected $guarded = ['id_disposisi'];
    protected $table = 'disposisi';
    protected $primaryKey = 'id_disposisi';

    public function arsip()
    {
        return $this->belongsTo(Arsip::class, 'arsip_id', 'id_arsip');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'arsip_id', 'id_arsip');
    }

    // many to many relationship 
    public function users()
    {
        return $this->belongsToMany(User::class, 'disposisi_user', 'disposisi_id', 'user_id');
    }
}
