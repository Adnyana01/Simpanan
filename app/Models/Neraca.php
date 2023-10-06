<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Neraca extends Model
{
    use HasFactory;
    protected $table = 'neraca';
    protected $guarded = [
        "id", "created_at", "updated_at"
    ];
    public function scopeYear($query, $year)
    {
        return $query->whereYear('tanggal_mulai', '=', $year);
    }
    public function nList(): BelongsTo
    {
        return $this->belongsTo(KategoriNeraca::class, "kategori_neraca_id");
    }
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriKegiatan::class, "kategori_id");
    }
    public function child(): HasMany
    {
        return $this->hasMany(NeracaChild::class, "parent_id");
    }
}
