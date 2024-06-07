<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LaratrustSeeder::class); 

        // \App\Models\User::factory(10)->create();

        $employee = Employee::factory()->create([
            'name'      => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('admin'),
            'phone'     => '0121113215',
            'address'   => 'address',
            'status'    => 'active',
        ]);
        $employee->addRole('manager');
    }
}
