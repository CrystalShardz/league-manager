<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'datetime_start'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'datetime_start'
    ];

    /**
     * Get the next available season name
     * @return string
     */
    public static function getNextName(): string
    {
        $last = Season::latest()->first();
        if (null == $last) {
            return "Season 1";
        } else {
            return "Season " . ($last->id + 1);
        }
    }

    public function teams()
    {
        return $this->belongstoMany(Team::class);
    }

    public function fixtures()
    {
        return $this->hasMany(Fixture::class);
    }
}
