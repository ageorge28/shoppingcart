<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\User;
use App\Models\Status;
use App\Models\File;
use App\Models\Address;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'cart_id',
        'billing_address_id',
        'shipping_address_id',
        'comments',
        'status_id',
        'invoice_id',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function billing_address()
    {
        return $this->belongsTo(Address::class, 'billing_address_id');
    }

    public function shipping_address()
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function invoice()
    {
        return $this->belongsTo(File::class, 'invoice_id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($order) { // before delete() method call this
             $order->cart()->delete();
             // do the rest of the cleanup...
        });
    }
}
