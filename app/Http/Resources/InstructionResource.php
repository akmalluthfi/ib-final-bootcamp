<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstructionResource extends JsonResource
{
    protected $message;

    public function __construct($instruction, $message)
    {
        parent::__construct($instruction);
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
                'id' => $this->id,
                'no' => $this->no,
                'link_to' => $this->link_to,
                'type' => $this->type,
                'assigned_vendor' => $this->assigned_vendor,
                'attention_of' => $this->attention_of,
                'quotation_no' => $this->quotation_no,
                'customer_po_no' => $this->customer_po_no,
                'status' => $this->status,
            ];
        } else {
            return $this->toArrayAll();
        }
    }

    public function toArrayAll()
    {
        return [
            'messsage' => $this->message,
            'data' => [
                'id' => $this->id,
                'status' => $this->status,
                'type' => $this->type,
                'no' => $this->no,
                'assigned_vendor' => $this->assigned_vendor,
                'attention_of' => $this->attention_of,
                'quotation_no' => $this->quotation_no,
                'vendor_address' => $this->vendor_address,
                'invoice_to' => $this->invoice_to,
                'customer' => $this->customer,
                'customer_po_no' => $this->customer_po_no,
                'costs' => $this->costs,
                'attachments' => $this->attachments,
                'note' => $this->note,
                'vendor_invoices' => $this->vendorInvoices,
                'internal' => $this->internal,
                'activity_notes' => $this->activity_notes,
                'link_to' => $this->link_to,
                'cancelation' => $this->cancelation,
                'created_at' => $this->updated_at->format('d/m/y h:i A'),
                'updated_at' => $this->updated_at->format('d/m/y h:i A'),
            ]
        ];
    }
}
