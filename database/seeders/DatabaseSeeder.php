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
        // User::factory(5)->create();

        // front-end members
        User::create([
            'name' => 'Nando Septian',
            'email' => 'nando@example.com',
            'password' => bcrypt('test')
        ]);

        User::create([
            'name' => 'Bintang Prayoga',
            'email' => 'bintang@example.com',
            'password' => bcrypt('test')
        ]);

        // back-end members
        User::create([
            'name' => 'Ricko Haikal',
            'email' => 'ricko@example.com',
            'password' => bcrypt('test')
        ]);

        User::create([
            'name' => 'Akmal Lutfhi',
            'email' => 'akmal@example.com',
            'password' => bcrypt('test')
        ]);

        User::create([
            'name' => 'Daffa Pratama',
            'email' => 'daffa@example.com',
            'password' => bcrypt('test')
        ]);

        User::create([
            'name' => 'Whisnumurty Galih',
            'email' => 'whisnu@example.com',
            'password' => bcrypt('test')
        ]);

        Vendor::factory(10)->create();
        InvoiceTarget::factory(10)->create();
        Customer::factory(10)->create();

        $this->call([
            TransactionSeeder::class,
            RecipientSeeder::class,
            InstructionSeeder::class,
        ]);
    }
}
