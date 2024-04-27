<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //project yg kita bikin studi kasusnya guru kepada murid
        //table model has role berfungsi utk menampung super admin, guru, murid dll

        $permissions = [
            'view courses',
            'create courses',
            'edit courses',
            'delete courses',
        ];

        // ini utk mengisi table Persmission spatie
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }

        // utk mengisi table role guru
        $teacherRole = Role::create([
            'name' => 'teacher',
        ]);


        // guru bisa view, create, edit, delete  
        $teacherRole->givePermissionTo([
            'view courses',
            'create courses',
            'edit courses',
            'delete courses',
        ]);

        // utk mengisi table role murid
        $studentRole = Role::create([
            'name' => 'student'
        ]);

        // dan murid hanya bisa view saja utk mengerjakan
        $studentRole->givePermissionTo([
            'view courses'
        ]);

        // super admin atau guru ini ibaratnya bisa segalanya, jadi pada saat di hosting super admin ini sudah ada tinggal di edit saja
        $user = User::create([
            'name' => 'Akbar Hossam',
            'email' => 'akbarhossam123@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole($teacherRole);
    }
}
