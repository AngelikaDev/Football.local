<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commands extends Model
{
    use HasFactory;
    
    protected $table = 'commands';

    protected $fillable = [
        'name',
        'image',
        'city',
        'coach',
        'stadium',
        'composition'
    ];

    protected $casts = [
        'composition' => 'array'
    ];

    public function coach(): HasOne 
    {
        return $this->hasOne(Players::class, 'id', 'coach');
    }

    public function stadium(): HasOne 
    {
        return $this->hasOne(Stadiums::class, 'id', 'stadium');
    }

    public function homeMatches(): HasMany
    {
        return $this->hasMany(Matches::class, 'hosts');
    }

    public function awayMatches(): HasMany
    {
        return $this->hasMany(Matches::class, 'guests');
    }
    
    public function setCompositionAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['composition'] = json_encode($value);
        } else {
            $this->attributes['composition'] = $value;
        }
    }

    public function getCompositionPlayers()
    {
        if (!$this->composition) {
            return collect();
        }

        if (is_array($this->composition)) {
            $playerIds = collect($this->composition)->pluck('player_id')->filter()->toArray();
        } else {
            
            $playerIds = json_decode($this->composition, true);
        }
 
        if (is_array($playerIds) && !empty($playerIds) && isset($playerIds[0]) && is_numeric($playerIds[0])) {
            return Players::whereIn('id', $playerIds)->get();
        }
        
        return collect();
    }
}