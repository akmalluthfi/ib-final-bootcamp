<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = [
            ['type' => 'Transfer', 'id' => 'TF'],
            ['type' => 'Call Of', 'id' => 'CO'],
            ['type' => 'Inspection', 'id' => 'INSP'],
        ];

        foreach ($transactions as $transaction) {
            for ($i = 0; $i < 7; $i++) {
                $date = date('Y');
                $index = str_pad($i, 4, "0", STR_PAD_LEFT);

                $t = new Transaction();
                $t->transaction_type = $transaction['type'];
                $t->transaction_id = "{$transaction['id']}-$date-$index";
                $t->save();
            }
        }
    }
}
