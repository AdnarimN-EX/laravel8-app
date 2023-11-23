<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Role::truncate();
        Role::insert([
            ['name' => 'ADMINISTRATOR'],
            ['name' => 'ENCODER'],
            ['name' => 'MANAGER'],
            ['name' => 'SUPERVISOR'],
            ['name' => 'SUPER ADMINISTRATOR'],
        ]);

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Role::insert([
            ['name' => 'ADMINISTRATOR'],
            ['name' => 'STAFF'],
        ]);

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
