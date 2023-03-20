<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendidikan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

      public function pencaker(): BelongsTo
    {
        return $this->belongsTo(Pencaker::class, 'id_pencaker', 'id');
    }
}
