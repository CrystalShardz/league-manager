<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use App\Models\Team;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class MembersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = Team::all();

        $faker = Container::getInstance()->make(Faker::class);

        foreach ($teams as $team) {
            for ($i = 0; $i < 4; $i++) {
                $team->members()->create([
                    'name' => $faker->name
                ]);
            }
        }
    }
}
