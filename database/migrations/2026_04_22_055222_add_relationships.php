<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // User Relationships
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('floor_id')
                ->nullable()
                ->after('current_team_id')
                ->constrained('floors')
                ->nullOnDelete();

            $table->foreignId('status_id')
                ->nullable()
                ->after('current_team_id')
                ->constrained('statuses')
                ->nullOnDelete();
        });
        
        // Desks Relationships
        Schema::table('desks', function (Blueprint $table) {
            $table->foreignId('floor_id')
                ->nullable()
                ->after('metadata')
                ->constrained('floors')
                ->nullOnDelete();
            
            $table->foreignId('status_id')
                ->nullable()
                ->after('metadata')
                ->constrained('statuses')
                ->nullOnDelete();

            $table->foreignId('team_id')
                ->nullable()
                ->after('metadata')
                ->constrained('teams')
                ->nullOnDelete();
        });

        // Floor Relationships
        Schema::table('floors', function (Blueprint $table) {
            $table->foreignId('status_id')
                ->nullable()
                ->after('metadata')
                ->constrained('statuses')
                ->nullOnDelete();
        });

        // Statuses Relationships
        Schema::table('statuses', function (Blueprint $table) {
            $table->foreignId('team_id')
                ->nullable()
                ->after('metadata')
                ->constrained('teams')
                ->nullOnDelete();
        });

        // Teams Relationships
        Schema::table('teams', function (Blueprint $table) {
            $table->foreignId('status_id')
                ->nullable()
                ->after('metadata')
                ->constrained('statuses')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
