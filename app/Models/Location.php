<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'enabled',
        'parent_id',
    ];
    protected $casts = [
        'enabled' => 'boolean'
    ];

    public function parent()
    {
        return $this->belongsTo(Location::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id', 'id');
    }

    public function disable()
    {
        $this->enabled = false;
        $this->save();
    }

    public function enable()
    {
        $this->enabled = true;
        $this->save;
    }
}
