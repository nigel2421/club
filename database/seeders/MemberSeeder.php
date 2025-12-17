<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;
use Faker\Factory as Faker;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Member::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'member_number' => $faker->unique()->numerify('MEM-####'),
                'contact_details' => $faker->phoneNumber,
                'status' => $faker->randomElement(['good_standing', 'delinquent']),
                'member_type' => $faker->randomElement(['regular', 'premium', 'vip']),
                'date_of_birth' => $faker->date(),
            ]);
        }
    }
}
