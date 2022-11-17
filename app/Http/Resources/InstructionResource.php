<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstructionResource extends JsonResource
{
    public function __construct($instructions = null, string $message = null)
    {
        parent::__construct($instructions);
        $this->message = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($request->routeIs('instructions.index')) {
            return [
                'id' => $this->_id,
                'instruction_type' => $this->instruction_type,
                'link_to' => $this->link_to,
                'assigned_vendor' => $this->assigned_vendor,
                'attention_of' => $this->attention_of,
                'quotation_no' => $this->quotation_no,
                'customer_po' => $this->customer_po,
                'status' => $this->status
            ];
        } else {
            return [
                'message' => $this->message,
                'data' => [
                    'id' => $this->_id,
                    'status' => $this->status,
                    'rev_count' => $this->rev_count,
                    'is_draft' => $this->is_draft,
                    'instruction_id' => $this->instruction_id,
                    'instruction_type' => $this->instruction_type,
                    'assigned_vendor' => $this->assigned_vendor,
                    'attention_of' => $this->attention_of,
                    'quotation_no' => $this->quotation_no,
                    'vendor_address' => $this->vendor_address,
                    'vendor_invoice' => $this->vendor_invoice,
                    'customer' => $this->customer,
                    'customer_po_no' => $this->customer_po_no,
                    'cost' => $this->cost,
                    'attachments' => $this->attachments,
                    'notes' => $this->notes,
                    'link_to' => $this->link_to,
                    'internal_only' => [
                        'attachments' => $this->attachments,
                        'internal_note' => $this->internal_note
                    ],
                    'activity_note' => [
                        'note' => $this->note,
                        'performed_by' => $this->performed_by,
                        'date' => $this->date
                    ],
                    'cancellation' => [
                        'reason' => $this->reason,
                        'canceled_by' => $this->canceled_by,
                        'attachment' => $this->attachment
                    ],
                ]
            ];
        }
    }
}
