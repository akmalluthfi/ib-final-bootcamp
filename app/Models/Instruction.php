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
        'rev_count' => 0,
        'is_draft' => false,
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

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
        'cost',
        'attachments',
        'notes',
        'link_to',
        'activity_note',
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
