<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstructionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'instruction_id' => 'LI-' . date('Y') . '-' . $this->faker->randomNumber(4, true),
            'instruction_type' => 'LI',
            'assigned_vendor' => $this->faker->company(),
            'attention_of' => $this->faker->firstName(),
            'quotation_no' => $this->faker->randomNumber(5, true),
            'vendor_address' => $this->faker->address(),
            'vendor_invoice' => null,
            'invoice_to' => $this->faker->firstName(),
            'customer' => $this->faker->firstName(),
            'customer_po_no' => null,
            'cost' => null,
            'attachments' => null,
            'notes' => $this->faker->text(100),
            'link_to' => null,
            'internal_only' => [
                'attachments' => null,
                'internal_note' => null
            ],
            'activity_note' => [
                [
                    'note' => 'Created',
                    'noted_by' => 'Alfi',
                    'date' => (new \DateTime('now'))->format('Y-m-d H:i:s')
                ]
            ],
            'cancellation' => [
                'reason' => null,
                'canceled_by' => null,
                'attachment' => null
            ],
        ];
    }

    public function test()
    {
        $instruction = new \App\Models\Instruction;

        $instruction->instruction_id = 'LI-' . date('Y') . '-000';
        $instruction->instruction_id = 'LI';

        $instruction->assigned_vendor = $this->faker->catchPhrase();
        $instruction->attention_of = $this->faker->firstName();
        $instruction->quotation_no = $this->faker->randomNumber(5, true);
        $instruction->vendor_address = $this->faker->address();

        $instruction->vendor_invoice = null;
        $instruction->invoice_to = $this->faker->firstName();
        $instruction->customer = $this->faker->firstName();
        $instruction->customer_po_no = null;

        $instruction->cost = null;

        $instruction->attachments = null;
        $instruction->notes = $this->faker->text(100);
        $instruction->link_to = null;


        $instruction->internal_only = [
            'attachments' => null,
            'internal_note' => null
        ];

        $instruction->activity_note = [
            [
                'note' => 'Created',
                'noted_by' => 'Alfi',
                'date' => (new \DateTime('now'))->format('Y-m-d H:i:s')
            ]
        ];


        $instruction->cancellation = [
            'reason' => null,
            'canceled_by' => null,
            'attachment' => null
        ];

        $instruction->save();
    }
}
