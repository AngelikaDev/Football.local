<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goals extends Model
{
    use HasFactory;
    
    protected $table = 'goals';

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