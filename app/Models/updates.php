<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class updates extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'incident_no','user_id','public'];

    public function incident()
    {
        return $this->belongsTo(incidents::class,'incident_no');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function isMyComment()
    {
        return $this->user_id == Auth::id();
    }

    public function isPublic()
    {
        return $this->public;
    }
}
