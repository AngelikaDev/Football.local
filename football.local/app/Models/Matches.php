<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Matches extends Model
{
    use HasFactory;
    
    protected $table = 'matches';
    
    protected $fillable = [
        'hosts',
        'guests', 
        'stadium',
        'date',
        'hosts_goals',
        'guests_goals',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function host(): BelongsTo
    {
        return $this->belongsTo(Commands::class, 'hosts', 'id');
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Commands::class, 'guests', 'id');
    }

    public function stadiumInfo(): BelongsTo
    {
        return $this->belongsTo(Stadiums::class, 'stadium', 'id');
    }

    public function stadiumRelation(): BelongsTo
    {
        return $this->belongsTo(Stadiums::class, 'stadium', 'id');
    }

    public function goals(): HasMany
    {
        return $this->hasMany(Goals::class, 'match');
    }

    public function yellowCards(): HasMany
    {
        return $this->hasMany(YellowCards::class, 'match');
    }

    public function redCards(): HasMany
    {
        return $this->hasMany(RedCards::class, 'match');
    }

    public function matchRelation()
    {
        return $this->hasMany(Goals::class, 'match');
    }


    public function getDisplayAttribute()
    {
        $host = $this->host ? $this->host->name : 'Команда #' . $this->hosts;
        $guest = $this->guest ? $this->guest->name : 'Команда #' . $this->guests;
        
        return $host . ' vs ' . $guest;
    }

    public function getSafeDate()
    {
        try {
            return $this->date instanceof Carbon 
                ? $this->date 
                : Carbon::parse($this->date);
        } catch (\Exception $e) {
            return now();
        }
    }
    
    public function getFormattedDate()
    {
        return $this->getSafeDate()->format('d.m.Y');
    }

    public function getFormattedTime()
    {
        return $this->getSafeDate()->format('H:i');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now());
    }
    
    public function scopePast($query)
    {
        return $query->where('date', '<', now());
    }
}