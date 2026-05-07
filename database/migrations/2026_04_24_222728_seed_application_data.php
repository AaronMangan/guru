<?php

use App\Models\Desk;
use App\Models\Team;
use App\Models\User;
use App\Models\Floor;
use App\Models\Status;
use App\Models\Building;
use App\Enums\TeamRole;
use App\Models\Membership;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Buildings are the top level container.
     * 
     * @var array
     */
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

    /**
     * Buildings contain floors and desks. This is the data to seed the floors and desks for the buildings.
     * 
     * @var array
     */
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

    /**
     * Example desks to add to the platform.
     * 
     * @var array
     */
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
            'floor_id' => 1,
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
     * Add Status data. This is used for the status of the desk,
     * such as available, booked, or unavailable.
     */
    const STATUSES = [
        [
            'name' => 'Available',
            'description' => 'The desk is available for booking',
        ],
        [
            'name' => 'Booked',
            'description' => 'The desk is currently booked by a user',
        ],
        [
            'name' => 'Unavailable',
            'description' => 'The desk is unavailable for booking due to maintenance or other reasons',
        ],
    ];

    /**
     * Teams to be added for testing.
     * 
     * @var array
     */
    const TEAMS = [
        [
            'name' => 'Team A',
            'description' => 'A - Team',
            'is_personal' => false,
        ],
        [
            'name' => 'Team B',
            'description' => 'B - Team',
            'is_personal' => false,
        ],
    ];

    /**
     * Seed the supradmin user.
     * 
     * @var array
     */
    const USERS = [
        [
            'name' => 'Aaron Mangan',
            'email' => 'azza.mangan@gmail.com',
            'password' => 'azza.mangan@gmail.com',
            'role' => 'super_admin',
            'current_team_id' => 1,
        ],
    ];

    /**
     * Create the roles and permissions for the applicatsion.
     * 
     * @var array
     */
    const ROLES_AND_PERMISSIONS = [
        'super_admin' => [
            'all_permissions',
        ],
        'admin' => [
            'view_buildings',
            'view_floors',
            'view_desks',
            'view_team',
            'manage_desks',
            'manage_team',
            'manage_users',
        ],
        'member' => [
            'view_buildings',
            'view_floors',
            'view_desks',
            'view_teams',
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $numDesks = env('NUMBER_OF_DESKS', 22);

        /* Add building data */
        foreach (self::BUILDINGS as $building) {
            Building::create($building);
        }

        /* Add Floor Data */
        foreach (self::FLOORS as $floor) {
            Floor::create($floor);
        }

        for ($i=0; $i < $numDesks; $i++) { 
            Desk::create([
                'floor_id' => rand(1, count(self::FLOORS)),
                'name' => 'Desk ' . ($i + 1),
                'number' => 'D' . ($i + 1),
                'description' => 'This is desk number ' . ($i + 1),
                'location' => 'N53.1.' . ($i + 1),
                'notes' => null,
                'metadata' => null,
            ]);
        }

        /* Seed statuses */
        foreach (self::STATUSES as $status) {
            Status::create($status);
        }

        /* Teams */
        foreach(self::TEAMS as $team) {
            $team = Team::create($team);
        }

        /* Add Roles and Permissions data */
        foreach (self::ROLES_AND_PERMISSIONS as $role => $permissions) {
            Role::create(['name' => $role]);
            $roleInstance = Role::where('name', $role)->first();
            collect($permissions)->each(function ($permission) {
                Permission::firstOrCreate(['name' => $permission]);
            });
            $roleInstance->givePermissionTo($permissions);
        }

        /* Seed user data */
        foreach (self::USERS as $user) {
            $userInstance = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt($user['password']),
                'current_team_id' => $user['current_team_id'] ?? null,
            ]);

            $userInstance->assignRole($user['role']);
        }

        /* Seed membership data */
        foreach (self::USERS as $user) {
            $userInstance = User::where('email', $user['email'])->first();
            Membership::create([
                'user_id' => $userInstance->id,
                'team_id' => $user['current_team_id'],
                'role' => TeamRole::Owner,
            ]);
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
