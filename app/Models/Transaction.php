<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Transaction extends Model
{
    public function scopeForLogisticInstruction($query)
    {
        return $query->where('type', 'Transfer')->orWhere('type', 'Call Of');
    }
}
