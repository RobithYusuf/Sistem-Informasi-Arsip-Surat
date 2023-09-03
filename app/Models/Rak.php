<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;


    protected $guarded = ['id_rak'];
    protected $table = 'rak';
    protected $primaryKey = 'id_rak';
    
}
