<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $volleyballClubNames = [
            "New York Volleyball Club",
            "Los Angeles Volleyball Group",
            "Chicago Volleyball Community",
            "Houston Volleyball Club",
            "Phoenix Volleyball Group",
            "Philadelphia Volleyball Community",
            "San Antonio Volleyball Club",
            "San Diego Volleyball Group",
            "Dallas Volleyball Community",
            "San Jose Volleyball Club",
            "Austin Volleyball Group",
            "Jacksonville Volleyball Community",
            "San Francisco Volleyball Club",
            "Indianapolis Volleyball Group",
            "Columbus Volleyball Community",
            "Fort Worth Volleyball Club",
            "Charlotte Volleyball Group",
            "Seattle Volleyball Community",
            "Denver Volleyball Club",
            "Washington Volleyball Group"
        ];

        // Birthday
        $dateFounded = [
            "1987-05-12",
            "1999-09-23",
            "1975-03-05",
            "2002-11-17",
            "1980-08-30",
            "1965-12-09",
            "1978-02-14",
            "1990-07-21",
            "1995-04-03",
            "1988-10-28",
            "1969-06-16",
            "1973-01-07",
            "1982-04-19",
            "2001-10-10",
            "1992-08-25",
            "1985-03-28",
            "1971-09-05",
            "1997-06-08",
            "1960-02-23",
            "1989-11-12",
        ];


        $addresses = [
            "123 Main St, Springfield",
            "456 Elm St, Oakville",
            "789 Maple Ave, Lakeside",
            "321 Oak St, Riverdale",
            "567 Pine St, Hillcrest",
            "890 Cedar Dr, Sunnyvale",
            "234 Birch Ln, Meadowbrook",
            "876 Willow St, Parkside",
            "543 Cherry Ave, Riverside",
            "210 Aspen Rd, Mountainview",
            "987 Oakwood Blvd, Beachside",
            "654 Birchwood Dr, Pinegrove",
            "321 Cedarwood Ln, Brookside",
            "876 Maplewood Ave, Woodland",
            "543 Elmwood Ct, Lakeshore",
            "210 Pinecrest Rd, Hilltop",
            "789 Willow Ln, Riverside",
            "456 Cedarhill Dr, Orchard",
            "123 Cherrywood Ave, Parkview",
            "890 Maplehill Rd, Springvale",
        ];

        $mobileNumbers = [
            "09234567890",
            "09765432109",
            "09876543210",
            "09654321870",
            "09123456789",
            "09987654321",
            "09543218760",
            "09321098765",
            "09432109876",
            "09456789012",
            "09109876543",
            "09432109876",
            "09987654321",
            "09543218760",
            "09765432109",
            "09234567890",
            "09654321870",
            "09543218760",
            "09123456789",
            "09876543210"
        ];

        $logo = [
            "club_logo/club1.png",
            "club_logo/club2.png",
            "club_logo/club3.png",
            "club_logo/club4.png",
            "club_logo/club5.png",
            "club_logo/club6.png",
            "club_logo/club7.png",
            "club_logo/club3.png",
            "club_logo/club4.png",
            "club_logo/club2.png",
            "club_logo/club1.png",
            "club_logo/club7.png",
            "club_logo/club6.png",
            "club_logo/club5.png",
            "club_logo/club3.png",
            "club_logo/club7.png",
            "club_logo/club6.png",
            "club_logo/club2.png",
            "club_logo/club5.png",
            "club_logo/club1.png"
        ];

        $uid = [
            1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
        ];

        $inviteCodes = [
            "aB3cDfG5",
            "hI9jKlM7",
            "nOpQrStU",
            "vWxYz01",
            "23AbCdEf",
            "45GhIjKl",
            "67MnOpQr",
            "89StUvWx",
            "z01AbCdE",
            "fGhIjKlM",
            "nOpQrStU",
            "vWxYz01",
            "23AbCdEf",
            "45GhIjKl",
            "67MnOpQr",
            "89StUvWx",
            "z01AbCdE",
            "fGhIjKlM",
            "nOpQrStU",
            "vWxYz01"
        ];

        for ($i=0; $i<20; $i++){
            DB::table('clubs')->insert([
                'c_name' => $volleyballClubNames[$i],
                'c_date_founded' => $dateFounded[$i],
                'c_address' => $addresses[$i],
                'c_logo' => $logo[$i],
                'c_email' => "sampleclubemail@example.com",
                'c_mobile' => $mobileNumbers[$i],
                'c_invite_code' => $inviteCodes[$i],
                'c_u_id' => $uid[$i]
            ]);
        }



    }
}
