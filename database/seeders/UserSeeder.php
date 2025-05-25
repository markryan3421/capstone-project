<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 17) as $i) {
            $name = "project-manager $i";

            $user = User::create([
                'name' => $name,
                // 'sdg_id' => $sdgId,  
                'user_slug' => Str::slug($name),
                'email' => "pm$i@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
                'current_sdg_id' => $i,
            ]);

            $user->assignRole('project-manager');
        }

        foreach (range(1, 17) as $i) {
            $name = "staff $i";

            $user = User::create([
                'name' => $name,
                // 'sdg_id' => $sdgId,  
                'user_slug' => Str::slug($name),
                'email' => "staff$i@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
                'current_sdg_id' => $i,
            ]);

            $user->assignRole('staff');
        }
    }
}
