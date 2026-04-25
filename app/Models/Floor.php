<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'building_id', 'level', 'description', 'metadata',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}
