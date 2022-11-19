<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'no'
    ];

    public function scopeForLogisticInstruction($query)
    {
        return $query->where('type', 'Transfer')->orWhere('type', 'Call Of');
    }
}
