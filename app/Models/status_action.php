<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_action extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['action','status_id'];

    public function status()
    {
        return $this->belongsTo(status::class,'status_id','id');
    }
    
}
