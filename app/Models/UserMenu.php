<?php

namespace App\Models;


use App\Models\UserAccessMenu;
use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{

    protected $guarded = ['id_user_menu'];
    protected $table = 'user_menu';
    protected $primaryKey = 'id_user_menu';

    //menu dinamis
    public function userAccessMenus()
    {
        return $this->hasMany(UserAccessMenu::class, 'menu_id', 'id_user_menu');
    }

    public function submenus()
    {
        return $this->hasMany(UserSubmenu::class, 'menu_id', 'id_user_menu');
    }
}
