<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NeracaChild extends Model
{
    use HasFactory;
    protected $table = 'neraca_child';
    protected $guarded = [
        "id", "created_at", "updated_at"
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Neraca::class, "parent_id");
    }
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriKegiatan::class, "kategori_id");
    }
}
