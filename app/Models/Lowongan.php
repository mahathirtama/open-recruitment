<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lowongan extends Model
{
    use HasFactory;
     protected $guarded = ['id'];

     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
     public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan', 'id');
    }
     public function perusahaan_daftar_event(): BelongsTo
    {
        return $this->belongsTo(Perusahaan_Daftar_Event::class, 'id_perusahaan_daftar_event', 'id');
    }
     public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'id_event', 'id');
    }
}
