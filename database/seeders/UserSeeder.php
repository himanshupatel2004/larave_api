<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', "seeder@gmail.com")->first();

        if (!$user) {
            $user = new User();
        }
        $user->name = "Seeder";
        $user->email = "seeder@gmail.com";
        $user->password = Hash::make("aaa");
        $user->address = "I Am Seeder";
        $user->phone = "7838115261";
        $user->save();
    }
}