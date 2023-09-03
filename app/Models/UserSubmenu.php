<?php

namespace App\Models;

use App\Models\UserMenu;
use Illuminate\Database\Eloquent\Model;

class UserSubmenu extends Model
{

    protected $guarded = ['id_submenu'];
    protected $table = 'user_submenu';
    protected $primaryKey = 'id_submenu';


    public function menu()
    {
        return $this->belongsTo(UserMenu::class, 'menu_id', 'id_user_menu');
    }
}
