<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_history extends Model
{
    use HasFactory;

    protected $fillable = ['incident_id','status','user_id','assigned_to','assigned_group'];
}
