<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriKegiatan extends Model
{
    use HasFactory;
    protected $table = 'kategori_kegiatan';
    protected $guarded = [
        "id", "created_at", "updated_at"
    ];

    public function neraca(): HasMany
    {
        return $this->hasMany(Neraca::class, 'kategori_id');
    }
    public function nChild(): HasMany
    {
        return $this->hasMany(NeracaChild::class, 'kategori_id');
    }
}
