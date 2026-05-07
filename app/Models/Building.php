<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'address', 'code', 'description', 'metadata', 'team_id'])]
class Building extends Model
{
    public function floors()
    {
        return $this->hasMany(Floor::class);
    }
}
