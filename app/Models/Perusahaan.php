<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perusahaan extends Model
{
    use HasFactory;
     protected $guarded = ['id'];

     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
     public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class, 'id_bidang', 'id');
    }
     public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi', 'id');
    }
}
