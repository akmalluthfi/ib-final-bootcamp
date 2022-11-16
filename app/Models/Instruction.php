<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;

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

    public function vendorInvoices()
    {
        return $this->embedsMany(VendorInvoice::class, 'vendor_invoices');
    }
}
