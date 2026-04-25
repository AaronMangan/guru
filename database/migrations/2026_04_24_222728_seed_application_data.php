<?php

use App\Models\Desk;
use App\Models\Team;
use App\Models\User;
use App\Models\Floor;
use App\Models\Status;
use App\Models\Building;
use App\Models\Membership;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    const BUILDINGS = [
        [
            'name' => 'N53',
            'address' => 'Campus Heart, Griffith University, 170 Kessels Rd, Nathan QLD 4111',
            'code' => 'N53',
            'description' => 'N53 is a modern building located in the heart of Griffith University',
        ],
        [
            'name' => 'N55',
            'address' => 'Campus Heart, Griffith University, 170 Kessels Rd, Nathan QLD 4111',
            'code' => 'N55',
            'description' => 'N55 is a state-of-the-art building designed for collaborative learning',
        ],
    ];

    const FLOORS = [
        [
            'building_id' => 1,
            'level' => 1,
            'name' => 'Ground Floor',
        ],
        [
            'building_id' => 1,
            'level' => 2,
            'name' => 'First Floor',
        ],
        [
            'building_id' => 2,
            'level' => 1,
            'name' => 'Ground Floor',
        ],
        [
            'building_id' => 2,
            'level' => 2,
            'name' => 'First Floor',
        ],
    ];

    const DESKS = [
        [
            'floor_id' => 1,
            'name' => 'Desk 1',
            'number' => 'N53.1.1',
            'description' => 'A comfortable desk with a view of the campus',
            'location' => 'N53.1.1',
            'notes' => null,
            'metadata' => null,
        ],
        [
            'floor_id' => 1,
            'name' => 'Desk 2',
            'number' => 'N53.1.2',
            'description' => 'A quiet desk located near the windows',
            'location' => 'N53.1.2',
            'notes' => null,
            'metadata' => null,
        ],
        [
            'floor_id' => 2,
            'name' => 'Desk 3',
            'number' => 'N53.2.1',
            'description' => 'A spacious desk with plenty of natural light',
            'location' => 'N53.2.1',
            'notes' => null,
            'metadata' => null,
        ],
        [
            'floor_id' => 2,
            'name' => 'Desk 4',
            'number' => 'N53.2.2',
            'description' => 'A cozy desk perfect for focused work',
            'location' => 'N53.2.2',
            'notes' => null,
            'metadata' => null,
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add Building data
        foreach (self::BUILDINGS as $building) {
            Building::create($building);
        }

        // Add Floor data
        foreach (self::FLOORS as $floor) {
            Floor::create($floor);
        }

        // Add Desk data
        foreach (self::DESKS as $desk) {
            Desk::create($desk);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
