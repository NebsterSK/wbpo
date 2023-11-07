<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create();

        $user->tokens()->create([
            'name' => 'api',
            'token' => 'c4b9151a173d93e5bfd8e865ea442f4e5183f3ac60a449c9fc1881e75019e62b',
            'abilities' => ['api'],
            'expires_at' => now()->addDays(30),
        ]);

//        Payment::factory()->create();
    }
}
