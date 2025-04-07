<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => PaymentStatus::class,
        'method' => PaymentMethod::class,
    ];

    protected $fillable = [
        'client_id', 
        'professional_id', 
        'amount', 
        'profit_tax', 
        'remote_ip',
        'type', 
        'status',
        'method', 
        'payment_status',
        'updated_at', 
    ];
}
