<?php

namespace Database\Seeders;

use App\Models\Instruction;
use Faker\Factory;
use Illuminate\Database\Seeder;

class InstructionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $type = $faker->randomElement(['LI', 'SI']);

            $instruction = Instruction::create([
                'no' => $type . '-' . date('Y') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'type' => $type,
                'assigned_vendor' => $faker->company(),
                'attention_of' => $faker->firstName(),
                'quotation_no' => $faker->randomNumber(5, true),
                'vendor_address' => $faker->address(),
                'invoice_to' => $faker->firstName(),
                'customer' => $faker->firstName(),
                'customer_po_no' => $faker->randomNumber(4, true),
                'costs' => $this->createCost(mt_rand(1, 5)),
                'attachments' => null,
                'note' => $faker->text(100),
                'link_to' => null,
                'activity_notes' => [
                    [
                        'note' => 'Created',
                        'performed_by' => 'Alfi',
                        // 'date' => (new \DateTime('now'))->format('d/m/y h:i A')
                        'date' => now()->format('d/m/y h:i A')
                    ]
                ],
                'cancellation' => null
            ]);

            $instruction->vendorInvoices()->createMany($this->createVendorInvoice(mt_rand(1, 3)));

            $internal = $instruction->internal()->create([
                'attachments' => null
            ]);

            $internal->notes()->createMany($this->createInternalNote(mt_rand(1, 3)));
        }
    }

    public function createVendorInvoice($count)
    {
        $rows = [];
        for ($i = 0; $i < $count; $i++) {
            $rows[] = [
                'no' => 'INV-' . date('Y') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'attachment' => null,
                'supporting_documents' => null
            ];
        }

        return $rows;
    }

    public function createInternalNote($count)
    {
        $faker = Factory::create();
        $rows = [];

        for ($i = 0; $i < $count; $i++) {
            $rows[] = [
                'note' => $faker->text(50),
                'noted_by' => $faker->firstName(),
            ];
        }

        return $rows;
    }

    public function createCost($count)
    {
        $faker = Factory::create();

        $qty = mt_rand(1, 5);
        $price = mt_rand(100, 500);
        $discount = mt_rand(5, 15);
        $total_barang = $qty * $price;
        $sub_total = $total_barang - ($total_barang * $discount / 100);
        $vat = mt_rand(5, 10);

        $rows = [];
        for ($i = 0; $i < $count; $i++) {
            $rows[] = [
                'description' => $faker->sentence(),
                'qty' => $qty,
                'uom' => $faker->randomElement(['SHP', 'BILL', 'HRS', 'MEN', 'PCS', 'TRIP', 'MT']),
                'unit_price' => $price,
                'discount' => $discount,
                'vat' => $vat,
                'sub_total' =>  $sub_total,
                'total' => $sub_total + ($sub_total * $vat / 100),
                'charge_to' => $faker->randomElement(['Customer', 'Inosoft'])
            ];
        }

        return $rows;
    }
}
