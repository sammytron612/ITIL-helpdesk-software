<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class updates extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'incident_no','user_id'];

    public function incident()
    {
        return $this->belongsTo(incidents::class,'id');
    }

    public function isMyComment()
    {
        return $this->user_id == Auth::id();
    }
}
