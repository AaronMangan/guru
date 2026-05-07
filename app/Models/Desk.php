<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['number', 'location', 'notes', 'metadata', 'floor_id', 'status_id', 'team_id'])]
class Desk extends Model
{
    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}
