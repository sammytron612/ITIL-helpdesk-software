<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class incidents extends Model
{
    use HasFactory;



    protected $fillable = ['status', 'status_history', 'title', 'priority', 'category', 'department','assigned_to', 'created_by', 'site' , 'department', 'assigned_group','reassignments'];

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

    public function assigned_agent()
    {
        return $this->hasOne(User::class, 'id', 'assigned_to');
    }

    public function requested_by()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function group()
    {
        return $this->hasOne(agent_group::class, 'id', 'agent_group');
    }

    public function descriptions()
    {
        return $this->hasOne(Comments::class, 'incident_no');
    }

    public function chosen_site()
    {
        return $this->hasOne(sites::class, 'id', 'site');
    }
    public function status_histories()
    {
        return $this->hasMany(status_history::class,'incident_id');
    }

    public function assignedToAgent()
    {
        return $this->assigned_to === true;
    }
}
