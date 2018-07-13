<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'user',
            'description' => 'Normal user',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => 'Administrator',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
