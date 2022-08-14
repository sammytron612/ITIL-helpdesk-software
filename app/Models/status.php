<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory;

    public function incident()
    {
        return $this->belongsTo(incidents::class, 'status', 'id');
    }
    
    public function status_histories()
    {
        return $this->hasMany(status_history::class,'incident_id');
    }
}
