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

    public function scopeSearch($query, $keyword)
    {
        return $query->where('no', 'like', "%$keyword%")
            ->orWhere('type', 'like', "%$keyword%")
            ->orWhere('link_to', 'like', "%$keyword%")
            ->orWhere('assigned_vendor', 'like', "%$keyword%")
            ->orWhere('attention_of', 'like', "%$keyword%")
            ->orWhere('quotation_no', 'like', "%$keyword%")
            ->orWhere('status', 'like', "%$keyword%")
            ->orWhere('customer_po_no', 'like', "%$keyword%");
    }

    public function scopeTabOpen($query)
    {
        return $query->where('status', 'In Progress')->orWhere('status', 'Draft');
    }

    public function scopeTabCompleted($query)
    {
        return $query->where('status', 'Completed')->orWhere('status', 'Cancelled');
    }
}
