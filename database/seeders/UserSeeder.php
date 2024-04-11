<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //// First Names
        $firstNames = [
            "Emma",
            "Liam",
            "Olivia",
            "Noah",
            "Ava",
            "William",
            "Sophia",
            "Oliver",
            "Isabella",
            "Elijah",
            "Charlotte",
            "James",
            "Amelia",
            "Benjamin",
            "Mia",
            "Lucas",
            "Harper",
            "Henry",
            "Evelyn",
            "Alexander",
            "Abigail",
            "Daniel",
            "Emily",
            "Jackson",
            "Elizabeth",
            "Michael",
            "Scarlett",
            "Ethan",
            "Grace",
            "Sebastian"
        ];

        // Middle Names
        $middleNames = [
            "Alexander",
            "Grace",
            "James",
            "Rose",
            "Michael",
            "Elizabeth",
            "David",
            "Marie",
            "Thomas",
            "Anne",
            "Joseph",
            "Louise",
            "Christopher",
            "Claire",
            "Matthew",
            "Catherine",
            "William",
            "Jane",
            "Benjamin",
            "Victoria",
            "Samuel",
            "Elizabeth",
            "Andrew",
            "Lynn",
            "Jonathan",
            "Marie",
            "Jacob",
            "Emily",
            "Ryan",
            "Michelle"
        ];

        // Last Names
        $lastNames = [
            "Smith",
            "Johnson",
            "Williams",
            "Brown",
            "Jones",
            "Garcia",
            "Miller",
            "Davis",
            "Rodriguez",
            "Martinez",
            "Hernandez",
            "Lopez",
            "Gonzalez",
            "Wilson",
            "Anderson",
            "Thomas",
            "Taylor",
            "Moore",
            "Jackson",
            "Martin",
            "Lee",
            "Perez",
            "Thompson",
            "White",
            "Harris",
            "Sanchez",
            "Clark",
            "Lewis",
            "Robinson",
            "Walker"
        ];


        // Address
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
            "234 Birchwood Dr, Hillcrest",
            "987 Pinewood Ct, Lakeside",
            "654 Oakwood Blvd, Oakdale",
            "321 Willow St, Riverdale",
            "876 Maple Ave, Meadowbrook",
            "543 Cedar Dr, Sunnyvale",
            "210 Elmwood Ln, Parkside",
            "789 Cherry Ave, Riverside",
            "456 Cedarwood Ct, Mountainview"
        ];

        // Mobile
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
            "09876543210",
            "09109876543",
            "09321098765",
            "09765432109",
            "09456789012",
            "09876543210",
            "09234567890",
            "09456789012",
            "09321098765",
            "09123456789",
            "09654321870"
        ];

        // Birthday
        $birthDates = [
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
            "1977-07-03",
            "1963-05-15",
            "1984-12-26",
            "1993-01-31",
            "1976-04-07",
            "1967-10-18",
            "2000-07-29",
            "1996-08-14",
            "1979-09-01",
            "1981-06-20"
        ];

        for ($i = 0; $i < 25; $i++)
        {
            $uid = DB::table('users')->insertGetId([
                'email' => $firstNames[$i].'@example.com',
                'password' => Hash::make('password'),
            ]);

            DB::table('user_information')->insert([
                'ui_first_name' => $firstNames[$i],
                'ui_middle_name' => $middleNames[$i],
                'ui_last_name' => $lastNames[$i],
                'ui_address' => $addresses[$i],
                'ui_mobile' => $mobileNumbers[$i],
                'ui_birthday' => $birthDates[$i],
                'ui_u_id' => $uid,
            ]);

        }
    }
}
