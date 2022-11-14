<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;

    protected $connection = "mongodb";
    protected $collection = 'instruction';

    protected $fillable = ['status', 'activity_note', 'note', 'performed_by', 'date', 'cancellation', 'canceled_by', 'reason', 'attachment'];
}
