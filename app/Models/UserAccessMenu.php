<?php

namespace App\Models;

use App\Models\Role;
use App\Models\UserMenu;
use Illuminate\Database\Eloquent\Model;

class UserAccessMenu extends Model
{

    protected $guarded = ['id_user_access_menu'];
    protected $table = 'user_access_menu';
    protected $primaryKey = 'id_user_access_menu';


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id_role');
    }

    public function menu()
    {
        return $this->belongsTo(UserMenu::class, 'menu_id', 'id_user_menu');
    }
}
