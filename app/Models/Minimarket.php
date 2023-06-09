<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Minimarket extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function facility(): HasMany
    {
        return $this->hasMany(MinimarketFacility::class);
    }

    public function picture(): HasMany
    {
        return $this->hasMany(Picture::class);
    }

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function supplier(): HasMany
    {
        return $this->hasMany(Supplier::class);
    }
}
