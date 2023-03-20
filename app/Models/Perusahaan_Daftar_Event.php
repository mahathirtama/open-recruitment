<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perusahaan_Daftar_Event extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

      public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan', 'id');
    }
      public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'id_event', 'id');
    }
}
