<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotel_master'; 
    protected $primaryKey = 'id'; 
    public $timestamps = false; 

    protected $fillable = [
        'hotel_name', 
        'contact_name', 
        'email', 
        'password', 
        'phone', 
        'photo', 
        'street', 
        'city', 
        'state', 
        'zipcode', 
        'active_code', 
        'all_staff', 
        'is_department', 
        'is_commission', 
        'tripadvisor_link', 
        'additional_email', 
    ];

    protected $casts = [
        'all_staff' => 'string',
        'is_active' => 'string',
    ];
}
