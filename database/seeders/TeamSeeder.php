<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('team_member_roles')->insert([
            'tmr_role' => 'Player',
            'tmr_description' => 'Team Player',
        ]);

        DB::table('team_member_roles')->insert([
            'tmr_role' => 'Captain',
            'tmr_description' => 'Team Captain',
        ]);

        DB::table('team_member_roles')->insert([
            'tmr_role' => 'Coach',
            'tmr_description' => 'Team Coach',
        ]);

        DB::table('team_member_roles')->insert([
            'tmr_role' => 'Coach',
            'tmr_description' => 'Assistant Coach',
        ]);



    }
}
