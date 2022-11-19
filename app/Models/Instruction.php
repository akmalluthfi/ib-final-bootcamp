<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Instruction extends Model
{
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'In Progress',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'no',
        'type',
        'assigned_vendor',
        'attention_of',
        'quotation_no',
        'vendor_address',
        'invoice_to',
        'customer',
        'customer_po_no',
        'costs',
        'attachments',
        'note',
        'link_to',
        'activity_notes',
        'cancellation'
    ];

    public function internal()
    {
        return $this->embedsOne(Internal::class);
    }

    public function vendorInvoices()
    {
        return $this->embedsMany(VendorInvoice::class, 'vendor_invoices');
    }
}
