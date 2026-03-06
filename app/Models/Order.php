<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'student_name', 'student_email',
        'student_phone', 'payment_method', 'payment_status',
        'order_status', 'total_amount', 'notes', 'upi_transaction_id'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusColorAttribute()
    {
        return match ($this->order_status) {
            'pending'    => 'yellow',
            'confirmed'  => 'blue',
            'preparing'  => 'orange',
            'ready'      => 'green',
            'delivered'  => 'gray',
            'cancelled'  => 'red',
            default      => 'gray',
        };
    }

    public function getPaymentStatusColorAttribute()
    {
        return match ($this->payment_status) {
            'paid'    => 'green',
            'pending' => 'yellow',
            'failed'  => 'red',
            default   => 'gray',
        };
    }
}