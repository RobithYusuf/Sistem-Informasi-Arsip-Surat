<?php

namespace App\Models;

use App\Models\User;
use App\Models\UserMenu;
use App\Models\UserAccessMenu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['id_role'];
    protected $table = 'role';
    protected $primaryKey = 'id_role';

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function userAccessMenus()
    {
        return $this->hasMany(UserAccessMenu::class, 'role_id', 'id_role');
    }

    public function menus()
    {
        return $this->belongsToMany(UserMenu::class, 'user_access_menu', 'role_id', 'menu_id', 'id_role', 'id_user_menu');
    }
}
