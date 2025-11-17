<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stadiums extends Model
{
    use HasFactory;
    protected $table ='stadiums';

    protected $fillable = [
        'name',
        'city',
    ];

    public function matches(): HasMany
    {
        return $this->hasMany(Matches::class, 'stadium', 'id');
    }
}