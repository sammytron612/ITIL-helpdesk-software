<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class priority extends Model
{
    use HasFactory;

    public function incidents()
    {
        return $this->belongsTo(incidents::class);
    }
}
