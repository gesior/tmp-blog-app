<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->state([
                'email' => 'admin@example.com',
                'role' => User::ROLE_ADMIN,
            ])
            ->create();

        User::factory()
            ->count(3)
            ->sequence(fn(Sequence $sequence) => ['email' => 'editor' . $sequence->index . '@example.com',])
            ->state(['role' => User::ROLE_EDITOR])
            ->has(Post::factory()->count(3), 'posts')
            ->create();

        User::factory(10)->create();
        User::factory()->count(10)->unverified()->create();
    }
}
