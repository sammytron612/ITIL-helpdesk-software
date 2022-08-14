<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_history extends Model
{
    use HasFactory;

    protected $fillable = ['incident_id','status','old_status','user_id','assigned_to','assigned_group'];

    public function incident()
    {
        return $this->belongsTo(incidents::class, 'id','incident_id');
    }

    public function status_name()
    {
        return $this->HasOne(status::class, 'id','status');
    }

    public function actioned_by()
    {
        return $this->HasOne(User::class, 'id','user_id');
    }

    public function assigned_agent()
    {
        return $this->hasOne(User::class, 'id','assigned_to');
    }

    public function assigned_queue()
    {
        return $this->hasOne(agent_group::class, 'id','assigned_group');
    }
}
