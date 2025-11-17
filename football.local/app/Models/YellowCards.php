<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class YellowCards extends Model
{
    use HasFactory;

    protected $table ='yellow_cards';
    
    protected $fillable = [
        'match',
        'player',
        'minutes',
        'seconds'
    ];

    public function matchInfo(): BelongsTo
    {
        return $this->belongsTo(Matches::class, 'match', 'id');
    }

    public function playerInfo(): BelongsTo
    {
        return $this->belongsTo(Players::class, 'player', 'id');
    }

    public function matchRelation(): BelongsTo
    {
        return $this->belongsTo(Matches::class, 'match', 'id');
    }

    public function playerRelation(): BelongsTo
    {
        return $this->belongsTo(Players::class, 'player', 'id');
    }
}