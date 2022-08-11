<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_membership extends Model
{
    use HasFactory;

    protected $fillable = ['agent_group','user_id'];
    public $timestamps = false;
}
