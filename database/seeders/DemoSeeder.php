<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a demo user
        $user = User::create([
            'username' => 'demo',
            'password' => Hash::make('password'),
        ]);

        // Create a demo message
        Message::create([
            'user_id' => $user->id,
            'message_text' => "Happy Valentine's Day! 💕\n\nYou make every day brighter with your smile. Thank you for being the most amazing person in my life. Here's to many more beautiful moments together!\n\nWith all my love,\nYour Valentine ❤️",
            'share_slug' => 'demo123456',
        ]);

        $this->command->info('Demo user and message created!');
        $this->command->info('Username: demo');
        $this->command->info('Password: password');
        $this->command->info('Demo message: http://localhost:8000/m/demo123456');
    }
}
