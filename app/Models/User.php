<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ticket_assigned()
    {
        return $this->belongs_to(incidents::class, 'assigned_to', 'id');
    }

    public function ticket_owner()
    {
        return $this->belongs_to(incidents::class);
    }

    public function my_avatar()
    {
        return $this->hasOne(avatar::class,'user_id');
    }

    public function updates()
    {
        return $this->belongTo(updates::class,'id');
    }

    public function history_status()
    {
        return $this->hasOne(status_history::class,'status');
    }

    public function history_actioned_by()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function history_assigned_to()
    {
        return $this->belongsTo(User::class, 'assigned_to','id');
    }

    public function isAdmin()
    {
        return $this->admin == 1;
    }

    public function isAgent()
    {
        return $this->role == 'agent';
    }
}
