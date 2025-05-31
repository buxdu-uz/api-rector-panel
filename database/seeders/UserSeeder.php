<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(
            [
                'name' => 'admin'
            ]);

        Role::updateOrCreate(
            [
                'name' => 'rector'
            ]);

        Role::updateOrCreate(
            [
                'name' => 'teacher'
            ]);

        $teacher = User::updateOrCreate([
            'employee_id_number' => '3042311060',
        ],[
            'login' => '3042311060',
            'fullname' => 'SALIMOV BEHRUZBEK SOBIROVICH',
            'password' => '3042311060'
        ]);

        $teacher->assignRole('teacher','admin', 'rector');
    }
}
