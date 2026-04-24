<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desk extends Model
{
    //
    protected $fillable = [
        'number', 'location', 'notes', 'metadata', 'floor_id', 'status_id', 'team_id'
    ];
}
