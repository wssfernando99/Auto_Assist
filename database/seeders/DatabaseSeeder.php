<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'userId' => uniqid(),
        //     'name' => 'Sarindu Fernando',
        //     'email' => 'fernando@gmail.com',
        //     'role' => 'Admin',
        //     'contact' =>'0766674922',
        //     'isActive' => 1,
        //     'password' => Hash::make('123'),

        // ]);


        // Employee::factory()->create([
        //     'employeeId' => 'EM_'.Str::random_int(7,'0123456789'),
        //     'userId' => '679bb91d3f099',
        //     'name' => 'Sarindu Fernando',
        //     'email' => 'fernando@gmail.com',
        //     'contact' =>'0766674922',
        //     'isActive' => 1,
        //     'position' => 'Manager',
        //     'salary' => '100000',
        //     'joiningDate' => '01-01-2023',
        //     'emImage' => 'default.png',
        //     'address' => 'Colombo',
        //     'nic' => '987654321V',
        //     'gender' => 'Male',
        //     'dob' => '2000-01-01',
        // ]);

        Customer::factory()->create([
            'customerId' => 'CU_'.random_int(1000000, 9999999),
            'userId' => '679bb91d3f099',
            'name' => 'Isuru Perera',
            'email' => 'isuru@gmail.com',
            'contact' =>'0766674922',
            'isActive' => 1,
            'address' => 'Colombo',
            'check' => 0,
        ]);
    }
}
