<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Recipient;

use Faker\Factory;

class RecipientSeeder extends Seeder
{
    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            Recipient::create([
                'email' => $this->faker->email()
            ]);
        }
    }
}
