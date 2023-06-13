<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'first_name' => 'Admin',
            'last_name' => 'admin',
            'company_id' => null,
            'email' => 'admin@admin.com',
            'phone' => '09201234567',
            'type' => 1
        ]);
    }
}
