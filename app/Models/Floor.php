<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Fillable(['name', 'building_id', 'level', 'description', 'metadata', 'team_id'])]
class Floor extends Model
{
    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function desks()
    {
        return $this->hasMany(Desk::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }   
    
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
