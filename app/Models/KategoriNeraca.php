<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriNeraca extends Model
{
    use HasFactory;
    protected $table = 'kategori_neraca';
    protected $guarded = [
        "id", "created_at", "updated_at"
    ];

    public function neraca(): HasMany
    {
        return $this->hasMany(Neraca::class, 'neraca_id');
    }
}
