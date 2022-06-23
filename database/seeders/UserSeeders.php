<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $users = [
            [
                'name' => 'user',
                'email' => 'user@bgfs.com',
                'phone' => '00100',
                'role' => 'USER',
                'password' => 'bgfs001',
            ],
            [
                'name' => 'instructor',
                'email' => 'instructor@bgfs.com',
                'phone' => '00200',
                'role' => 'INSTRUCTOR',
                'password' => 'bgfs001',
            ],
            [
                'name' => 'admin',
                'email' => 'admin@bgfs.com',
                'phone' => '003 00',
                'role' => 'ADMIN',
                'password' => 'bgfs001',
            ]
        ];
        foreach ($users as $key => $user) {
            $new_user = new User; 
            $new_user->first_name = $user['name'];
            $new_user->last_name = 'bgfs';
            $new_user->email = $user['email'];
            $new_user->email_verified_at = now();
            $new_user->phone = $user['phone'];
            $new_user->phone_verified_at = now();
            $new_user->password = Hash::make($user['password']);
            $new_user->save();
            $new_user->assignRole($user['role']); 
        }
    }
}