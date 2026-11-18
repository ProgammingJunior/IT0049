<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class PosSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['Alice Johnson', 'alice@example.com', '555-0101'],
            ['Bob Smith', 'bob@example.com', '555-0102'],
            ['Carol Davis', 'carol@example.com', '555-0103'],
            ['David Brown', 'david@example.com', '555-0104'],
            ['Eva Wilson', 'eva@example.com', '555-0105'],
        ];

        foreach ($customers as [$fullName, $email, $phone]) {
            Customer::updateOrCreate(['email' => $email], [
                'full_name' => $fullName,
                'phone' => $phone,
            ]);
        }

        foreach ([
            ['admin', 'Alice Johnson'],
            ['bsmith', 'Bob Smith'],
            ['cdavis', 'Carol Davis'],
            ['dbrown', 'David Brown'],
            ['ewilson', 'Eva Wilson'],
        ] as [$username, $fullName]) {
            User::updateOrCreate(['username' => $username], ['full_name' => $fullName]);
        }
    }
}
