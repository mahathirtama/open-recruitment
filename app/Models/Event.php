<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;
      protected $guarded = ['id'];
    public function perusahaan_daftar_event(): BelongsTo
    {
        return $this->belongsTo(Perusahaan_Daftar_Event::class, 'id_perusahaan__daftar__events', 'id');
    }
}
