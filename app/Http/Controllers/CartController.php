<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\TaxShipping;
use App\Models\Coupon;
use App\Models\Company;
use App\Models\Product;
use App\Models\CartProduct;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        $title = 'Cart';

        if (Auth::user())
        {
            $cart = Cart::where([
                            ['user_id', Auth::id()],
                            ['flag', false]
                      ])->first();  
        }
        else
        {
            $cart = Cart::where([
                            ['user_id', session()->getId()],
                            ['flag', false]
                      ])->first();  
        }

        if (is_null($cart))
        {
            $cart = NULL;
        }

        return view('cart', compact('cart', 'companies', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        $cart_products = CartProduct::where('cart_id', $cart->id)->get();
        $companies = Company::all();
        return view('admin.carts.show', compact('cart', 'cart_products', 'companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect('/admin/carts')->with('success', 'Cart Deleted');
    }

    public function ajaxAdd($product_id, Request $request)
    {        
        $product = Product::find($product_id);
        
        $taxshipping = TaxShipping::first();


        if ($request->session()->has('quantities'))
        {
            $quantities = session('quantities');
            if (!Arr::exists($quantities, $product->id))
            {
                $quantities[$product->id] = $product->quantity;
            }
        }
        else
        {
            $quantities = array();
            $quantities[$product->id] = $product->quantity;
            // session('quantities', array());
        }

        $cart_quantity = $request->cart_quantity;
        if (Auth::user())
        {
            $cart = Cart::where([
                            ['user_id', Auth::id()],
                            ['flag', false]
                      ])->first();

            if (is_null($cart))
            {
                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->quantity = 0;
                $cart->subtotal = 0;
                $cart->shipping = $taxshipping->shipping;
                $cart->total = 0;
                $cart->flag = 0;
                $cart->is_guest = 0;
                $cart->date = now();
                $cart->save();
            }
        }
        else
        {
            $cart = Cart::where([
                            ['user_id', session()->getId()],
                            ['flag', false]
                      ])->first();     
            if (is_null($cart))
            {
                $cart = new Cart();
                $cart->user_id = session()->getId();
                $cart->quantity = 0;
                $cart->subtotal = 0;
                $cart->shipping = $taxshipping->shipping;
                $cart->flag = 0;
                $cart->total = 0;
                $cart->is_guest = 1;
                $cart->date = now();
                $cart->save();
            }
        }

        if ($product->quantity == 0)
        {
            return response()->json([
                'product' => '',
                'success' => 'This item is out of stock', 
                'title' => 'Out of stock',
                'quantity' => 0,
                'flag' => 1
            ]);
        }
        
        if (!is_null($cart_quantity) && $cart_quantity > $quantities[$product_id])
        {
            return response()->json([
                'product' => '',
                'success' => 'This item is out of stock', 
                'title' => 'Out of stock',
                'quantity' => 0,
                'flag' => 2
            ]);
        }
        else if (!is_null($cart_quantity) && $cart_quantity <= $quantities[$product_id])
        {            
            $cart_product = CartProduct::where('cart_id', $cart->id)->where('product_id', $product_id)->first();
            if (!$cart_product)
            {
                $cart_product = new CartProduct();
                $cart_product->cart_id = $cart->id;
                $cart_product->product_id = $product->id;
                $cart_product->quantity = 0;
                $cart_product->total = 0;              
            }
            $cart->quantity += $cart_quantity;
            $cart_product->quantity += $cart_quantity;
            // $product->quantity -= $cart_quantity;
            $quantities[$product->id] -= $cart_quantity; 
            $cart->subtotal -= $cart_product->total;
            $cart_product->total = $cart_product->quantity * $product->price;
            $cart->subtotal += $cart_product->total;
            $cart->tax = $cart->subtotal * $taxshipping->tax / 100;
            $cart->total = $cart->shipping + $cart->subtotal + $cart->tax;

            if ($quantities[$product->id] == 0)
            {
                // $product->flag = 1;                
            }

            session(['quantities' => $quantities]);
            // $product->save();
            $cart_product->save();
            $cart->save();

            $message = $cart_quantity . ' kg of '. $product->name . ' added to the cart';
            Session::flash('success', $message);
    
            return response()->json(array(
                'product' => '',
                'success' => $message, 
                'title' => 'Products added',
                'quantity' => $cart->items(),
                'flag' => 0
            ));
        }

        if ($cart)
        {
            $cart_product = CartProduct::where('cart_id', $cart->id)->where('product_id', $product->id)->first();

            if ($cart_product)
            {
                $cart_product->quantity ++;
                // $product->quantity--;
                $quantities[$product_id] --;
                $cart_product->total += $product->price;
                $cart->quantity ++;
                $cart->subtotal += $product->price;
                $cart->shipping = $taxshipping->shipping;
                $cart->tax = $cart->subtotal * $taxshipping->tax / 100;
                $cart->total = $cart->shipping + $cart->subtotal + $cart->tax;
            }
            else
            {
                $cart_product = new CartProduct();
                $cart_product->cart_id = $cart->id;
                $cart_product->product_id = $product->id;
                $cart_product->quantity = 1;
                // $product->quantity--;
                $quantities[$product->id]--;
                $cart_product->total = $product->price;
                $cart->quantity ++;
                $cart->subtotal += $product->price;
                $cart->shipping = $taxshipping->shipping;
                $cart->tax = $cart->subtotal * $taxshipping->tax / 100;
                $cart->total = $cart->shipping + $cart->subtotal + $cart->tax;
            }
            $cart_product->save();
            $cart->save();
        }
        else
        {
            $cart = new Cart();
            $cart_product = new CartProduct();
            $cart_product->cart_id = $cart->id;
            $cart_product->product_id = $product->id;
            $cart_product->quantity = 1;
            // $product->quantity--;
            $quantities[$product->id]--;
            $cart_product->total = $product->price;
            $cart_product->save();
            $cart->user_id = Auth::user() ? Auth::id() : session()->getId();
            $cart->is_guest = Auth::user() ? 0 : 1;
            $cart->quantity = 1;
            $cart->shipping = $taxshipping->shipping;
            $cart->subtotal = $product->price;
            $cart->tax = $cart->subtotal * $taxshipping->tax / 100;
            $cart->total = $cart->subtotal + $cart->shipping + $cart->tax;
            $cart->date = now();
            $cart->flag = false;
            $cart->save();
        }       

        if ($product->quantity == 0)
        {
            // $product->flag = 1;
        }

        // $product->save();
        session(['quantities' => $quantities]);

        return response()->json([
            'product' => $product->name,
            'success' => '1 kg ' . $product->name . ' has been added to your cart.',
            'title' => 'Item Added',
            'quantity' => $cart->items(),
            'flag' => 0
        ]);
    }

    public function ajaxUpdate(Request $request)
    {
        $taxshipping = TaxShipping::first();
        $cart_array = json_decode($request->cart_string);
        $cart_product = CartProduct::find($cart_array[0][0]);
        $cart = Cart::find($cart_product->cart_id);
        $cart_product_totals = array();
        if ($request->session()->has('quantities'))
        {
            $quantities = session('quantities');
        }
        else
        {
            $quantities = array();
            // session('quantities', array());
        }

        foreach($cart_array as $index => $cart_item)
        {   
            $cart_product = CartProduct::find($cart_item[0]);
            $product = Product::find($cart_product->product_id);
            
            if (is_null($quantities[$product->id]))
            {
                $quantities[$product->id] = $product->quantity;
            }

            if ($cart_item[1] > $quantities[$product->id])
            {
                $message = 'Cart cannot be updated. ' . $product->name . ' out of stock';
                Session::flash('danger', $message);
                return response()->json(array(
                    'cart_id' => $cart->id, 
                    'subtotal' => $cart->subtotal,
                    'shipping' => $cart->shipping,
                    'tax' => $cart->tax,
                    'total' => $cart->total,
                    'cart_totals' => $cart_product_totals,
                    'quantity' => $cart->items(),
                    'flag' => 1,
                    'success' => $message
                ));
            }
        }
        
        foreach($cart_array as $index => $cart_item)
        {
            $cart_product = CartProduct::find($cart_item[0]);
            $product = Product::find($cart_product->product_id);
            if($cart_item[1] == 0)
            {
                $cart->quantity -= $cart_product->quantity;
                $quantities[$product->id] += $cart_product->quantity;
                $cart_product->delete();
                array_push($cart_product_totals, 0);
            }
            else
            {
                $cart->quantity -= $cart_product->quantity;
                $cart_product->quantity = $cart_item[1];
                $cart_product->total = $cart_product->quantity * $product->price;
                array_push($cart_product_totals, $cart_product->total);
                $cart->quantity += $cart_product->quantity;
                $cart_product->save();
            }
        } 

        $cart->subtotal = $request->subtotal;

        if ($cart->subtotal == 0)
        {
            $cart->shipping = 0;
            $cart->tax = 0;
        }
        else
        {
            $cart->tax = $taxshipping->tax * $cart->subtotal / 100;
            $cart->shipping = $taxshipping->shipping;
        } 

        $cart->total = $cart->shipping + $cart->subtotal + $cart->tax;

        $cart->save();
        session(['quantities' => $quantities]);
               
        $message = 'Shopping Cart Updated Successfully';
        Session::flash('success', $message);

        return response()->json(array(
            'cart_id' => $cart->id, 
            'subtotal' => $cart->subtotal,
            'shipping' => $cart->shipping,
            'tax' => $cart->tax,
            'total' => $cart->total,
            'cart_totals' => $cart_product_totals,
            'quantity' => $cart->items(),
            'flag' => 0,
            'success' => $message
        ));
    }


    public function ajaxDelete($cart_product_id)
    {
        $taxshipping = TaxShipping::first();
        $cart_product = CartProduct::find($cart_product_id);

        if (session()->has('quantities'))
        {
            $quantities = session('quantities');
            if (!Arr::exists($quantities, $cart_product->product->id))
            {
                $quantities[$cart_product->product->id] = $cart_product->product->quantity;
            }
        }
        else
        {
            $quantities = array();
            $quantities[$cart_product->product->id] = $cart_product->product->quantity;
            session(['quantities' => $quantities]);
        }



        $product = Product::find($cart_product->product_id);
        if (Auth::user())
        {
            $cart = Cart::find($cart_product->cart_id)
                  ->where('user_id', Auth::id())
                  ->where('flag', 0)
                  ->first();
        }
        else
        {
            $cart = Cart::find($cart_product->cart_id)
                  ->where('user_id', session()->getId())
                  ->where('flag', 0)
                  ->first();
        }
        $cart->quantity -= $cart_product->quantity;
        $quantities[$cart_product->product_id] += $cart_product->quantity;
        $cart->subtotal -= $cart_product->total;
        $cart->shipping = $taxshipping->shipping;
        $cart->tax = $cart->subtotal * $taxshipping->tax / 100;
        $cart->total = $cart->shipping + $cart->subtotal + $cart->tax;
        $cart_product->delete();
        if ($cart->subtotal == 0)
        {
            $cart->shipping = 0;
            $cart->tax = 0;
            $cart->total = 0;
        }
        $cart->save();
        session(['quantities' => $quantities]);

        return response()->json(array(
            'success' => $product->name, 
            'subtotal' => $cart->subtotal,
            'shipping' => $cart->shipping,
            'tax' => $cart->tax,
            'total' => $cart->total,
            'quantity' => $cart->items()
        ));

        // return response()->json([
        //     'success' => $product->name,
        //     'subtotal' => $cart->subtotal,
        //     'total' => $cart->total
        // ]);
    }

    public function ajaxCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon)->first();
        if (Auth::user())
        {
            $cart = Cart::where('user_id', Auth::id())
                      ->where('flag', 0)
                      ->first();
        }
        else
        {
            $cart = Cart::where('user_id', session()->getId())
                      ->where('flag', 0)
                      ->first();
        }
        $state  = $request->state;

        if (is_null($coupon) && $state == 1)
        {
            $message = 'Coupon Code Not Found';
            $cart->coupon_id = 0;
            $discount = 0;
            $flag  = 0;
            $cart->total = $cart->shipping + $cart->subtotal + $cart->tax;
        }
        elseif (!is_null($coupon) && $state == 1)
        {
            $message = 'Coupon Applied';
            $cart->coupon_id = $coupon->id;
            $discount = $cart->subtotal * $coupon->discount / 100;
            $cart->total = $cart->shipping + $cart->subtotal - $discount + $cart->tax;
            $flag = 1;
        }
        elseif (!is_null($coupon) && $state == 0)
        {
            $message = 'Coupon Removed';
            $cart->coupon_id = 0;
            $discount = 0;
            $cart->total = $cart->shipping + $cart->subtotal + $cart->tax;
            $flag = 0;
        }

        $cart->save();

        return response()->json(array(
            'discount' => $discount,
            'total' => $cart->total,
            'flag' => $flag,
            'success' => $message
        ));
    }
}
