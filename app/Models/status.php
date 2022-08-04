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

    public function action()
    {
        return $this->hasOne(status_history::class,'id','status_id');
    }
}
