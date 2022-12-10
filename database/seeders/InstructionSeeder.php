<?php

namespace Database\Seeders;

use App\Models\Customer;
use Faker\Factory;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Instruction;
use App\Models\InvoiceTarget;
use App\Models\Transaction;
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
        $users = ['Nando Septian', 'Bintang Prayoga', 'Ricko Haikal', 'Akmal Lutfhi', 'Daffa Pratama', 'Whisnumurty Galih'];
        for ($i = 0; $i < 50; $i++) {
            $vendor = Vendor::raw(function($collection){
                return $this->inRandomOrder($collection);
            })
            ->first();

            $customer = Customer::raw(function($collection){
                return $this->inRandomOrder($collection);
            })
            ->first();

            $invoiceTarget = InvoiceTarget::raw(function($collection){
                return $this->inRandomOrder($collection);
            })
            ->first();

            $type = $this->faker->randomElement(['LI', 'SI']);
            $status = $this->faker->randomElement(['In Progress', 'Draft', 'Completed', 'Cancelled']);
            $activityNotes = [];
            $activityNotes[] = [
                'note' => 'Create 3rd Party Instruction',
                'performed_by' => $this->faker->randomElement($users),
                'date' => now()->format('d/m/y h:i A')
            ];

            if ($status === 'Draft') {
                $activityNotes[] = [
                    'note' => 'Create Draft ' . ucwords($type),
                    'performed_by' => $this->faker->randomElement($users),
                    'date' => now()->format('d/m/y h:i A')
                ];
            }

            if ($status === 'Completed') {
                $activityNotes[] = [
                    'note' => 'Received All Invoice 3rd Party Instruction',
                    'performed_by' => $this->faker->randomElement($users),
                    'date' => now()->format('d/m/y h:i A')
                ];
            }

            if ($status === 'Cancelled') {
                $user = $this->faker->randomElement($users);
                $activityNotes[] = [
                    'note' => 'Cancel 3rd Party Instruction',
                    'performed_by' => $user,
                    'date' => now()->format('d/m/y h:i A')
                ];

                $cancellation = [
                    'reason' => $this->faker->sentence(),
                    'attachments' => null,
                    'cancelled_by' => $user
                ];
            }

            $chance = rand(0, 1);
            if($chance === 1){
                if($type === 'LI'){
                    $transaction = Transaction::raw(function($collection){
                        $pipelines = [
                            ['$match' => [
                                '$or' => [
                                    ['type' => 'Transfer'],
                                    ['type' => 'Call Of']
                                ]
                            ]],
                            ['$sample' => ['size' => 1]]
                        ];

                        return $this->inRandomOrder($collection, $pipelines);
                    })
                    ->first();
                } else {
                    $transaction = Transaction::raw(function($collection){
                        return $this->inRandomOrder($collection);
                    })
                    ->first();
                }

                $linkTo = $transaction->no;
            }

            Instruction::create([
                'status' => $status,
                'type' => $type,
                'no' => $type . '-' . date('Y') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'assigned_vendor' => $vendor->name,
                'attention_of' => $this->faker->firstName(),
                'quotation_no' => 'MITME-ADL-' . $this->faker->randomNumber(3, true),
                'vendor_address' => $vendor->addresses[rand(0, 1)],
                'invoice_to' => $invoiceTarget->name,
                'customer' => $customer->name,
                'customer_po_no' => 'PO' . $this->faker->randomNumber(2, true),
                'costs' => $this->createCost(mt_rand(1, 5)),
                'attachments' => [],
                'note' => $this->faker->text(100),
                'vendor_invoices' => $this->createVendorInvoice(mt_rand(1, 3)),
                'internal' => [
                    'attachments' => [],
                    'notes' => $this->createInternalNote(mt_rand(1, 3))
                ],
                'link_to' => $linkTo ?? null,
                'cancellation' => $cancellation ?? null,
                'activity_notes' => $activityNotes
            ]);

            unset($linkTo, $cancellation);
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
            $user = User::raw(function($collection) {
                return $this->inRandomOrder($collection);
            })
            ->first();

            $rows[] = [
                '_id' => new \MongoDB\BSON\ObjectId(),
                'user_id' => $user->id,
                'note' => $this->faker->text(50),
                'noted_by' => $user->name,
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
        $sub_total = $total_barang - ($total_barang * ($discount / 100));
        $vat = mt_rand(5, 10);
        $vat_ammount = $sub_total * ($vat/100);

        $rows = [];
        for ($i = 0; $i < $count; $i++) {
            $rows[] = [
                'description' => $this->faker->sentence(),
                'qty' => $qty,
                'uom' => $this->faker->randomElement(['SHP', 'BILL', 'HRS', 'MEN', 'PCS', 'TRIP', 'MT']),
                'unit_price' => $price,
                'discount' => $discount,
                'vat' => $vat,
                'vat_ammount' => $vat_ammount,
                'sub_total' =>  $sub_total,
                'total' => $sub_total + $vat_ammount,
                'charge_to' => $this->faker->randomElement(['Customer', 'Inosoft'])
            ];
        }

        return $rows;
    }

    public function inRandomOrder($collection, $pipelines = [['$sample' => ['size' => 1]]])
    {
        return $collection->aggregate($pipelines);
    }
}
