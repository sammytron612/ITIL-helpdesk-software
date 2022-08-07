<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class updates extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'incident_no'];

    public function incident()
    {
        return $this->belongsTo(incidents::class,'id');
    }
}
