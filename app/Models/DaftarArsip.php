<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarArsip extends Model
{
    use HasFactory;

    protected $guarded = ['id_daftar_arsip'];
    protected $table = 'daftar_arsip';
    protected $primaryKey = 'id_daftar_arsip';
}
