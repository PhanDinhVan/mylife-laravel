<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company')->insert([
            'name' => 'MyLife Coffee',
            'type' => 'coffee',
            'description' => 'Coffee',
            'contact' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('company')->insert([
            'name' => 'Yen SUSHI & SAKE PUB',
            'type' => 'sushi',
            'description' => 'SUSHI & SAKE PUB',
            'contact' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('company')->insert([
            'name' => 'YEN SUSHI PREMIUM',
            'type' => 'premium',
            'description' => 'YEN SUSHI PREMIUM',
            'contact' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
