<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee_master';

    protected $fillable = [
        'first_name',
        'last_name',
        'hotel_id',
        'department',
        'phone',
        'email',
        'photo',
        'password',
        'bank_name',
        'routing_number',
        'account_number',
        'is_archive'
    ];

    protected $hidden = [
        'password',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function tips()
    {
        return $this->hasMany(Tip::class, 'employee');
    }

}
