<?php

namespace Database\Seeders;

use App\Models\team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class defaultAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create(
            [
            'name' => 'employee',
            'email' => 'employee@employee.com',
            'password' => bcrypt('employee'),
            'role' => 'employee',
            'team_id'=> '2'
            ]
            );
 
    }
}