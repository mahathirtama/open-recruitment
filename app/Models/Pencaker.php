<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pencaker extends Model
{
    use HasFactory;
     protected $guarded = ['id'];

      public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
      public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi', 'id');
    }

     public function pengalaman(): HasMany
    {
        return $this->hasMany(Pengalaman::class, 'id_pencaker', 'id');
    }

     public function pendidikan(): HasMany
    {
        return $this->hasMany(Pendidikan::class, 'id_pencaker', 'id');
    }
}
