<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agent_group extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['email','name','auto_assign','assign_method','counter'];

    public function incident()
    {
        return $this->belongs_to(incidents::class, 'assigned_group','id');
    }

    public function isAutoAssign()
    {
        return $this->auto_assign == 1;
    }

    public function isRoundRobin()
    {
        return $this->assign_method == 'round_robin';
    }
    
}
