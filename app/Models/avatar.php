<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avatar extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id','colour', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
}
