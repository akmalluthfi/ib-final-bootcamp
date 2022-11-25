<?php

namespace App\Http\Resources;

use App\Models\Instruction;
use Illuminate\Http\Resources\Json\JsonResource;

class InstructionResource extends JsonResource
{
    protected $message;

    public function __construct(Instruction $instruction, $message)
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
                'invoice_to' => $this->invoice_to,
                'vendor_address' => $this->vendor_address,
                'customer' => $this->customer,
                'customer_po_no' => $this->customer_po_no,
                'costs' => $this->costs,
                'attachments' => $this->attachments,
                'note' => $this->note,
                'internal' => $this->internal,
                'vendor_invoices' => VendorInvoiceResource::collection($this->vendorInvoices),
                'link_to' => $this->link_to,
                'cancellation' => $this->cancellation,
                'activity_notes' => $this->activity_notes,
                'created_at' => $this->updated_at->format('d/m/y h:i A'),
                'updated_at' => $this->updated_at->format('d/m/y h:i A'),
                ]
            ];
    }
}
