<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Customer;
use App\Models\InvoiceTarget;
use Illuminate\Database\Seeder;
use Database\Seeders\TransactionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        Vendor::factory(10)->create();
        InvoiceTarget::factory(10)->create();
        Customer::factory(10)->create();

        $this->call([
            InstructionSeeder::class,
            TransactionSeeder::class,
            RecipientSeeder::class
        ]);
    }
}
