<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class incidents extends Model
{
    use HasFactory;

    protected $casts = [
        'status_history' => 'array',
        'sla' => 'array'
    ];



    protected $fillable = ['sla', 'status', 'status_history', 'title', 'priority', 'category', 'department','assigned_to', 'requestor', 'site' . 'department', 'assigned_group','re_assignments'];

    public function priorities()
    {
        return $this->hasOne(priority::class, 'id', 'priority');
    }

    public function ticket_updates()
    {
        return $this->hasMany(updates::class, 'incident_no');
    }

    public function departments()
    {
        return $this->hasOne(department::class, 'id', 'department');
    }

    public function statuses()
    {
        return $this->hasOne(status::class, 'id', 'status');
    }

    public function categories()
    {
        return $this->hasOne(category::class, 'id', 'category');
    }

    public function sub_categories()
    {
        return $this->hasOne(sub_category::class, 'id', 'sub_category');
    }

    public function assigned()
    {
        return $this->hasOne(User::class, 'id', 'assigned_to');
    }

    public function group()
    {
        return $this->hasOne(agent_group::class, 'id', 'assigned_group');
    }

    public function descriptions()
    {
        return $this->hasOne(Comments::class, 'incident_no');
    }

    public function requesting_user()
    {
        return $this->hasOne(User::class, 'id', 'requestor');
    }

    public function chosen_site()
    {
        return $this->hasOne(sites::class, 'id', 'site');
    }
}
