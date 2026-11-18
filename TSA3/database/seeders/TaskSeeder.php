<?php
namespace Database\Seeders;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
class TaskSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['username' => 'alexmorgan'], [
            'full_name' => 'Alex Morgan',
            'email' => 'alex.morgan@example.com',
        ]);

        $today = today();
        $samples = [
            ['Review the project timeline', 'pending', $today],
            ['Send the weekly team update', 'in progress', $today],
            ['Pick up groceries for dinner', 'pending', $today],
            ['Take a proper lunch break', 'completed', $today],
            ['Book the annual checkup', 'pending', $today->copy()->addDay()],
            ['Prepare notes for the planning meeting', 'pending', $today->copy()->addDay()],
            ['Return the library books', 'completed', $today->copy()->subDay()],
            ['Water the balcony plants', 'pending', $today->copy()->subDay()],
        ];

        foreach ($samples as [$title, $status, $date]) {
            Task::updateOrCreate(
                ['title' => $title, 'task_date' => $date->toDateString()],
                ['status' => $status],
            );
        }
    }
}
