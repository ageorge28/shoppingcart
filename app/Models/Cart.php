<?php

namespace App\Models;

use App\Models\User;
use App\Models\Coupon;
use App\Models\Status;
use App\Models\Product;
use App\Models\CartProduct;
use App\Models\TaxShipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable =  [
        'user_id',
        'quantity',
        'tax',
        'coupon_id',
        'shipping',
        'subtotal',
        'total',
        'date',
        'flag',
        'status_id',
        'is_guest'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(CartProduct::class);
    }
    
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public static function mergeCart($sessionid)
    {
        $usercart = Cart::where('user_id', Auth::id())->where('flag', 0)->first();
        $guestcart = Cart::where('user_id', $sessionid)->where('flag', 0)->first();
       
        if (is_null($guestcart) && is_null($usercart))
        {
            $cart = null;
        }
        elseif(is_null($guestcart) && !is_null($usercart))
        {
            $cart = $usercart;
        }
        elseif(!is_null($guestcart) && is_null($usercart))
        {
            $guestcart->user_id = Auth::id();
            $guestcart->is_guest = 0;
            $guestcart->save();
            $cart = $guestcart;
        }
        else
        {
            $usercart_products = CartProduct::where('cart_id', $usercart->id)->get();
            $guestcart_products = CartProduct::where('cart_id', $guestcart->id)->get();
            
            // Compare the contents of user cart and guest cart 
            foreach($guestcart_products as $guestcart_product)
            {
                $flag = 0;

                // Compare the contents of the current guest cart product with each user cart product 
                foreach($usercart_products as $usercart_product)
                {
                    // If matching product found add the quantities and totals
                    if ($usercart_product->product_id == $guestcart_product->product_id)
                    {
                        $flag = 1;
                        $usercart_product->quantity += $guestcart_product->quantity;
                        $usercart_product->total += $guestcart_product->total;
                        $usercart_product->save();
                        break;
                    }
                }

                // If no matching product found add the guest cart product to user cart
                if ($flag == 0)
                {
                    $guestcart_product->cart_id = $usercart->id;
                    $guestcart_product->save();
                }
            }

            $taxshipping = TaxShipping::first();

            // Calculate the new quantity and total of user cart
            $usercart->quantity = $usercart->products->sum('quantity');
            $usercart->subtotal = $usercart->products->sum('total');
            $usercart->shipping = $taxshipping->shipping;
            $usercart->tax = $usercart->subtotal * $taxshipping->tax / 100;
            $usercart->total = $usercart->subtotal + $usercart->shipping + $usercart->tax;
            $usercart->is_guest = 0;
            $usercart->save();
            $guestcart->delete();
            $cart = $usercart;
        }

        return $cart;
    }

    public function items()
    {
        $products = $this->products();
        return $products->count();
    }
}
