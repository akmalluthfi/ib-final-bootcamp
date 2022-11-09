<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Instruction;
use App\Models\InvoiceTarget;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Instruction::factory(50)->create();
        User::factory(5)->create();
        Vendor::factory(10)->create();
        InvoiceTarget::factory(10)->create();
        Customer::factory(10)->create();

        $this->call([
            TransactionSeeder::class
        ]);
    }
}
