<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Players extends Model
{
    use HasFactory;
    protected $table ='players';

    protected $fillable = [
        'name',
        'position',
        'country',
        'photo',
        
        'birth_date',
        'height', 
        'weight',
        'career',
        'achievements'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'career' => 'array',
        'achievements' => 'array',
    ];

    public function goals(): HasMany
    {
        return $this->hasMany(Goals::class, 'player');
    }

    public function yellowCards(): HasMany
    {
        return $this->hasMany(YellowCards::class, 'player');
    }

    public function redCards(): HasMany
    {
        return $this->hasMany(RedCards::class, 'player');
    }

    public function getCurrentTeamAttribute()
    {
        if (!$this->career) {
            return null;
        }

        $currentCareer = collect($this->career)
            ->whereNull('end_date')
            ->sortByDesc('start_date')
            ->first();

        return $currentCareer ? Commands::find($currentCareer['team_id']) : null;
    }

    public function getCurrentNumberAttribute()
    {
        if (!$this->career) {
            return null;
        }

        $currentCareer = collect($this->career)
            ->whereNull('end_date')
            ->sortByDesc('start_date')
            ->first();

        return $currentCareer['number'] ?? null;
    }
    
}