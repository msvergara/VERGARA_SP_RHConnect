<?php

namespace Database\Seeders;

use App\Models\Barangays;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $barangay_list = array(
            "Poblacion I",
            "Poblacion II",
            "Poblacion III",
            "Poblacion IV",
            "Betania",
            "Canantong",
            "Nauzon",
            "Pinagbayanan",
            "Sagana",
            "San Antonio",
            "San Felipe",
            "San Fernando",
            "San Isidro",
            "San Josep",
            "San Juan",
            "San Vicente",
            "Siclong",
        );

        foreach ($barangay_list as $b_list) {
            Barangays::create([
                'barangay_name' => $b_list
            ]);
        }
    }
}
