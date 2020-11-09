<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Team
 * @package App\Models
 * @property hasMany members
 * @property User captain
 * @method static create(array $array):Team
 * @method static find(int $team)
 */
class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'captain_id'
    ];

    public function members(): hasMany
    {
        return $this->hasMany(Member::class);
    }

    public function captain()
    {
        return $this->belongsTo(Member::class, 'captain_id');
    }

    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }
}
