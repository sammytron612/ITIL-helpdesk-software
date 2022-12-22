<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['incident','file_name'];

    public function incident()
    {
        return $this->belongsTo(incidents::class);
    }
}
