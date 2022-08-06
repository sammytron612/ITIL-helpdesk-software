<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title','parent'];

    public function incident()
    {
        return $this->belongsTo(incidents::class);
    }
}
