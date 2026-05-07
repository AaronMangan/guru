<?php

namespace App\Actions\Admin;

use App\Models\Desk;
use Illuminate\Support\Facades\DB;

class CreateDesk
{
    /**
     * Create a new desk.
     */
    public function handle(string $name): Desk
    {
        return DB::transaction(function () use ($name) {
            $desk = Desk::create([
                'name' => $name,
            ]);

            return $desk;
        });
    }
}