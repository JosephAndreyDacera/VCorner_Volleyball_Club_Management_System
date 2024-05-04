<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membership Type
        DB::table('membership_types')->insert([
            'mt_id' => 1,
            'mt_type' => 'Regular',
            'mt_code' => 'R',
        ]);

        DB::table('membership_types')->insert([
            'mt_id' => 2,
            'mt_type' => 'Associate',
            'mt_code' => 'A',
        ]);

        DB::table('membership_types')->insert([
            'mt_id' => 3,
            'mt_type' => 'Assistant Tournament Manager',
            'mt_code' => 'ATM',
        ]);

        DB::table('membership_types')->insert([
            'mt_id' => 4,
            'mt_type' => 'Tournament Manager',
            'mt_code' => 'TM',
        ]);

        DB::table('membership_types')->insert([
            'mt_id' => 5,
            'mt_type' => 'Assistant Club Manager',
            'mt_code' => 'ACM',
        ]);

        DB::table('membership_types')->insert([
            'mt_id' => 6,
            'mt_type' => 'Club Manager',
            'mt_code' => 'CM',
        ]);


        // //
        // for ($i=1; $i<21; $i++)
        // {
        //     DB::table('club_members')->insert([
        //         'cm_u_id' => $i,
        //         'cm_c_id' => 1,
        //         'cm_mt_id' => 1,
        //         'cm_date_joined' => '2024-12-04',
        //     ]);
        // }

        // for ($i=2; $i<21; $i++)
        // {
        //     DB::table('club_members')->insert([
        //         'cm_u_id' => $i,
        //         'cm_c_id' => $i,
        //         'cm_mt_id' => 1,
        //         'cm_date_joined' => '2024-12-04',
        //     ]);
        // }

        for($i = 1; $i<16; $i++){
            DB::table('club_members')->insert([
                'cm_u_id' => $i,
                'cm_c_id' => 1,
                'cm_mt_id' => 1,
                'cm_t_id' => 0,
                'cm_tmr_id' => 0,
                'cm_date_joined' => '2024-12-04',
            ]);
        }

    }
}
