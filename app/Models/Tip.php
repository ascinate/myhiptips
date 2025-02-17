<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    use HasFactory;

    protected $table = 'tips_master';
    public $timestamps = false;

    protected $fillable = [
        'hotel',
        'tip_type',
        'room_number',
        'last_name',
        'tip_amount',
        'final_amount',
        'employee',
        'department',
        'admin_commission',
        'each_share',
        'date_of_tip',
        'status'
    ];
}
