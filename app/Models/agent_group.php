<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agent_group extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['description'];
    
}
