<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class PosSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['Alice Johnson', 'alice@example.com', '555-0101'],
            ['Bob Smith', 'bob@example.com', '555-0102'],
            ['Carol Davis', 'carol@example.com', '555-0103'],
            ['David Brown', 'david@example.com', '555-0104'],
            ['Eva Wilson', 'eva@example.com', '555-0105'],
        ] as [$fullName, $email, $phone]) {
            Customer::updateOrCreate(['email' => $email], ['full_name' => $fullName, 'phone' => $phone]);
        }

        foreach ([
            ['admin', 'Alice Johnson', 'admin@example.com'],
            ['bsmith', 'Bob Smith', 'bob.smith@example.com'],
            ['cdavis', 'Carol Davis', 'carol.davis@example.com'],
            ['dbrown', 'David Brown', 'david.brown@example.com'],
            ['ewilson', 'Eva Wilson', 'eva.wilson@example.com'],
        ] as [$username, $fullName, $email]) {
            User::updateOrCreate(['username' => $username], [
                'full_name' => $fullName,
                'email' => $email,
                'password' => 'Daymark123!',
            ]);
        }
    }
}
