<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Instruction;
use Illuminate\Database\Seeder;

class InstructionSeeder extends Seeder
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
        for ($i = 0; $i < 50; $i++) {
            $type = $this->faker->randomElement(['LI', 'SI']);
            $status = $this->faker->randomElement(['In Progress', 'Draft', 'Completed', 'Cancelled']);
            $activityNotes = [];
            $activityNotes[] = [
                'note' => 'Create 3rd Party Instruction',
                'performed_by' => 'Alfi',
                'date' => now()->format('d/m/y h:i A')
            ];

            if ($status === 'Draft') {
                $activityNotes[] = [
                    'note' => 'Create Draft ' . ucwords($type),
                    'performed_by' => 'Ricko',
                    'date' => now()->format('d/m/y h:i A')
                ];
            }

            if ($status === 'Completed') {
                $activityNotes[] = [
                    'note' => 'Received All Invoice 3rd Party Instruction',
                    'performed_by' => 'Ricko',
                    'date' => now()->format('d/m/y h:i A')
                ];
            }

            if ($status === 'Cancelled') {
                $activityNotes[] = [
                    'note' => 'Cancel 3rd Party Instruction',
                    'performed_by' => 'Ricko',
                    'date' => now()->format('d/m/y h:i A')
                ];
            }

            $instruction = Instruction::create([
                'status' => $status,
                'type' => $type,
                'no' => $type . '-' . date('Y') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'assigned_vendor' => $this->faker->company(),
                'attention_of' => $this->faker->firstName(),
                'quotation_no' => $this->faker->randomNumber(5, true),
                'vendor_address' => $this->faker->address(),
                'invoice_to' => $this->faker->firstName(),
                'customer' => $this->faker->firstName(),
                'customer_po_no' => $this->faker->randomNumber(4, true),
                'costs' => $this->createCost(mt_rand(1, 5)),
                'attachments' => [],
                'note' => $this->faker->text(100),
                'vendor_invoices' => $this->createVendorInvoice(mt_rand(1, 3)),
                'internal' => [
                    'attachments' => [],
                    'notes' => $this->createInternalNote(mt_rand(1, 3))
                ],
                'link_to' => null,
                'cancellation' => null,
                'activity_notes' => $activityNotes
            ]);
        }
    }

    public function createVendorInvoice($count)
    {
        $rows = [];
        for ($i = 0; $i < $count; $i++) {
            $rows[] = [
                '_id' => new \MongoDB\BSON\ObjectId(),
                'no' => 'INV-' . date('Y') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'attachment' => null,
                'supporting_documents' => []
            ];
        }

        return $rows;
    }

    public function createInternalNote($count)
    {
        $rows = [];

        for ($i = 0; $i < $count; $i++) {
            $rows[] = [
                '_id' => new \MongoDB\BSON\ObjectId(),
                'note' => $this->faker->text(50),
                'noted_by' => $this->faker->firstName(),
            ];
        }

        return $rows;
    }

    public function createCost($count)
    {
        $qty = mt_rand(1, 5);
        $price = mt_rand(100, 500);
        $discount = mt_rand(5, 15);
        $total_barang = $qty * $price;
        $sub_total = $total_barang - ($total_barang * $discount / 100);
        $vat = mt_rand(5, 10);

        $rows = [];
        for ($i = 0; $i < $count; $i++) {
            $rows[] = [
                'description' => $this->faker->sentence(),
                'qty' => $qty,
                'uom' => $this->faker->randomElement(['SHP', 'BILL', 'HRS', 'MEN', 'PCS', 'TRIP', 'MT']),
                'unit_price' => $price,
                'discount' => $discount,
                'vat' => $vat,
                'sub_total' =>  $sub_total,
                'total' => $sub_total + ($sub_total * $vat / 100),
                'charge_to' => $this->faker->randomElement(['Customer', 'Inosoft'])
            ];
        }

        return $rows;
    }
}
