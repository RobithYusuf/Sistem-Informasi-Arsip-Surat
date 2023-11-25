<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id_role');
    }

    public function getUserRole()
    {
        return $this->role_id;
    }


    // many to many relationship
    public function arsips()
    {
        return $this->belongsToMany(Arsip::class, 'arsip_user', 'user_id', 'arsip_id');
    }

    public function disposisis()
    {
        return $this->belongsToMany(Disposisi::class, 'disposisi_user', 'user_id', 'disposisi_id');
    }
}
