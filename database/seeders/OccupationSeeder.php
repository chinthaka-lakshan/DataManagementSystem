<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Occupation;

class OccupationSeeder extends Seeder
{
    public function run(): void
    {
        $occupations = [

            // Agriculture
            'Farmer',
            'Assistant Farmer',
            'Agriculture Officer',
            'Field Assistant',
            'Livestock Farmer',
            'Fisherman',
            'Fishery Assistant',

            // Government & Administration
            'Government Officer',
            'Development Officer',
            'Grama Niladhari',
            'Samurdhi Officer',
            'Clerk',
            'Office Assistant',
            'Administrative Assistant',

            // Education
            'Teacher',
            'Assistant Teacher',
            'Lecturer',
            'Instructor',
            'School Principal',
            'Tutor',

            // Health Sector
            'Doctor',
            'Medical Officer',
            'Nurse',
            'Assistant Nurse',
            'Midwife',
            'Pharmacist',
            'Lab Technician',
            'Health Assistant',

            // Technical & Engineering
            'Engineer',
            'Assistant Engineer',
            'Civil Engineer',
            'Electrical Engineer',
            'Mechanical Engineer',
            'Technician',
            'Technical Assistant',

            // IT Sector
            'Software Engineer',
            'Software Developer',
            'IT Officer',
            'IT Assistant',
            'System Administrator',
            'Network Engineer',

            // Construction
            'Carpenter',
            'Mason',
            'Electrician',
            'Plumber',
            'Construction Worker',
            'Site Supervisor',

            // Transport
            'Driver',
            'Bus Driver',
            'Three Wheeler Driver',
            'Truck Driver',
            'Transport Assistant',

            // Business & Finance
            'Accountant',
            'Assistant Accountant',
            'Bank Officer',
            'Finance Officer',
            'Cashier',
            'Sales Executive',
            'Business Owner',
            'Shop Keeper',

            // Service Sector
            'Cleaner',
            'Office Helper',
            'Security Officer',
            'Security Guard',
            'Receptionist',
            'Hotel Staff',
            'Waiter',
            'Cook',
            'Chef',

            // Industrial
            'Factory Worker',
            'Machine Operator',
            'Production Assistant',
            'Garment Worker',

            // Miscellaneous
            'Self Employed',
            'Unemployed',
            'Student',
            'Retired',
            'Housewife',
            'Daily Wage Worker',

        ];

        foreach ($occupations as $job) {
            Occupation::firstOrCreate(['name' => $job]);
        }
    }
}