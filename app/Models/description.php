<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class description extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['description', 'incident_no'];

    public function incident()
    {
        return $this->belongsTo(incidents::class, 'id');
    }
}
