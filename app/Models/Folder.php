<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $guarded = ['id_folder'];
    protected $table = 'folder';
    protected $primaryKey = 'id_folder';
}
