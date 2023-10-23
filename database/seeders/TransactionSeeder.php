<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $amount = $faker->randomFloat(0, 0, 100000); // Generate nominal acak dalam rupiah
            $type = $faker->randomElement(['income', 'expense']);
            $category = $type === 'income'
                ? $faker->randomElement(['wage', 'bonus', 'gift'])
                : $faker->randomElement(['food & drinks', 'shopping', 'charity', 'housing', 'insurance', 'taxes', 'transportation']);
            $notes = $faker->text;
            $created_at = $faker->dateTimeBetween('-3 months', 'now');

            DB::table('transactions')->insert([
                'amount' => $amount,
                'type' => $type,
                'category' => $category,
                'notes' => $notes,
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);
        }
    }
}
