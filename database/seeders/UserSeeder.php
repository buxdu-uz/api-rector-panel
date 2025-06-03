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

        $rector = User::updateOrCreate([
            'employee_id_number' => '3041911001',
        ],[
            'login' => '3041911001',
            'fullname' => 'XAMIDOV OBIDJON XAFIZOVICH',
            'password' => '3041911001'
        ]);

        $hamza = User::updateOrCreate([
            'employee_id_number' => '3042011168',
        ],[
            'login' => '3042011168',
            'fullname' => 'ESHANKULOV HAMZA ILXOMOVICH',
            'password' => '3042011168'
        ]);

        $shef = User::updateOrCreate([
            'employee_id_number' => '3041411007',
        ],[
            'login' => '3041411007',
            'fullname' => 'XUSENOV MURODJON ZOXIROVICH',
            'password' => '3041411007'
        ]);

        $baxti = User::updateOrCreate([
            'employee_id_number' => '3040811007',
        ],[
            'login' => '3040811007',
            'fullname' => 'ADIZOV BAXTIYOR ISMATOVICH',
            'password' => '3040811007'
        ]);

        $shef->assignRole('teacher','admin', 'rector');
        $teacher->assignRole('teacher','admin', 'rector');
        $hamza->assignRole('admin');
        $baxti->assignRole('admin');
        $rector->assignRole('rector');
    }
}
