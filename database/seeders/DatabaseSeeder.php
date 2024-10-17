<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\Role;
use App\Models\User;
use App\Models\Job;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(50)->sequence(
            ['role_id' => 1],
            ['role_id' => 2]
        )->create();

        foreach ($users as $user) {

            if ($user->role_id === 1) {
                Candidate::factory()->create([
                    'user_id' => $user->id
                ]);
            } else {
                Company::factory()->create([
                    'user_id' => $user->id
                ]);
            }
        }

        Job::factory(50)->sequence(fn() => [
            'company_id' => Company::all()->random()
        ])->create();
    }
}
