<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'home_id',
        'away_id',
        'location_id',
        'start_at',
    ];
    protected $dates = [
        'start_at',
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function home()
    {
        return $this->belongsTo(Team::class, 'home_id');
    }

    public function away()
    {
        return $this->belongsTo(Team::class, 'away_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
