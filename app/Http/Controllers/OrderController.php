<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\User;
// use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\State;
use App\Models\Status;
use App\Models\Address;
use App\Models\Company;
use App\Models\Country;
use App\Models\Product;
use App\Models\District;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($order_id = NULL)
    {
        session()->put('order_id', $order_id);
        $companies = Company::all();
        $cities = City::all();
        $states = State::all();
        $districts = District::all();
        $title = 'Checkout';
        
        if (Auth::check())
        {
            $user = User::find(Auth::id());
        }
        else
        {
            $user = User::find(session()->getId());
        }

        $countries = Country::all();
        $cities = City::all()->sortBy('name');
        $states = State::all()->sortBy('state_title');
        $districts = District::all()->sortBy('district_title');

        if (Auth::user())
        {
            $addresses = Address::where('user_id', $user->id)->get();
        }
        else
        {
            $addresses = NULL;
        }

        // $cart = NULL;

        if ($order_id)
        {        
            $order = Order::find($order_id);
            $cart = $order->cart;
        }
        else
        {
            if (Auth::check())
            {
                $cart =  Cart::where('user_id', Auth::id())
                            ->where('flag', 0)
                            ->first();
            }
            else
            {
                $cart =  Cart::where('user_id', session()->getId())
                            ->where('flag', 0)
                            ->first();
            }
            $order = NULL;
        }

        return view('checkout', compact('cart', 'companies', 'user', 'countries', 'addresses', 'order', 'cities', 'states', 'districts', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if  ($request->is_guest == 1)
        {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|unique:users,email',
                'shipping_description' => 'required',
                'shipping_address1' => 'required',
                'shipping_city' => 'required|not_in:0',
                'shipping_district' => 'required|not_in:0',
                'shipping_state' => 'required|not_in:0',
                'shipping_country' => 'required|not_in:0',
                'billing_description' => 'required',
                'billing_address1' => 'required',
                'billing_city' => 'required|not_in:0',
                'billing_district' => 'required|not_in:0',
                'billing_state' => 'required|not_in:0',
                'billing_country' => 'required|not_in:0',
            ]);
        }
        else
        {
            $request->validate([
                'selected_shipping_address' => 'required',
                'selected_billing_address' => 'required'
            ]);
        }

        if (!is_null($request->order_id))
        {
            $order = Order::find($request->order_id);
            $cart = $order->cart;
        }
        else
        {
            if (Auth::check())
            {
                $cart =  Cart::where('user_id', Auth::id())
                            ->where('flag', 0)
                            ->first();
            }
            else
            {
                $cart =  Cart::where('user_id', session()->getId())
                            ->where('flag', 0)
                            ->first();
            }

            $order = new Order();
            $order->cart_id = $cart->id;

            if  ($request->is_guest == 1)
            {
                $user = new User();
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->save();

                $cart->user_id = $user->id;
                $order->user_id = $user->id;              
            }
            else
            {
                $order->user_id = Auth::id();
            }

            $cart->flag = 1;
            $cart->status_id = 1;
            $cart->save();

            $order->order_number = Order::max('order_number') + 1;
            $order->flag = 0;
            $order->status_id = 4;

            if ($request->selected_shipping_address > 0)
            {
                $order->shipping_address_id = $request->selected_shipping_address;
            }
            else
            {
                $address = new Address();               
                $address->user_id = $cart->user_id;
                $address->description = $request->shipping_description;
                $address->name = $request->shipping_contact_person;
                $address->phone = $request->shipping_contact_phone;
                $address->address1 = $request->shipping_address1;
                $address->address2 = $request->shipping_address2;
                $address->landmark = $request->shipping_landmark;
                $address->city = $request->shipping_city;
                $address->district = $request->shipping_district;
                $address->state = $request->shipping_state;
                $address->country = $request->shipping_country;
                $address->save();
                $order->shipping_address_id = $address->id;
            }

            if  ($request->has('same'))
            {
                $order->billing_address_id = $order->shipping_address_id;
            }
            elseif (!$request->has('same') && $request->selected_billing_address > 0)
            {
                $order->billing_address_id = $request->selected_billing_address;
            } 
            else
            {
                $address = new Address();
                $address->user_id = $cart->user_id;
                $address->description = $request->billing_description;
                $address->name = $request->billing_contact_person;
                $address->phone = $request->billing_contact_phone;
                $address->address1 = $request->billing_address1;
                $address->address2 = $request->billing_address2;
                $address->landmark = $request->billing_landmark;
                $address->city = $request->billing_city;
                $address->district = $request->billing_district;
                $address->state = $request->billing_state;
                $address->country = $request->billing_country;
                $address->save();
                $order->billing_address_id = $address->id;
            }

            $order->date = now();
            $order->save();
        }

        $companies = Company::all();
        $cart = NULL;


        $quantities = session('quantities');

        foreach($quantities as $item => $quantity)
        {
            $product = Product::find($item);
            $product->quantity = $quantity;
            if ($quantity == 0)
            {
                $product->flag = 1;
            }
            $product->save();
        }

        session()->put('order_id', $order->id);

        $title = 'Order';
        return view('order', compact('companies', 'order', 'cart', 'title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $statuses = Status::all();
        return view('admin.orders.edit', compact('statuses', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->status_id = $request->status;
        $order->save();

        $orders = Order::all();

        $user = User::find($order->user_id);
        $subject = 'Fruitkha Order Update';          
        $data = ['message' => 'Your Order number ' . $order->order_number . ' has now been updated with the status: ' . $order->status->status];
        Mail::to($user->email)->send(new WelcomeMail($data, $subject));

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect('/admin/orders')->with('success', 'Order Deleted');
    }
}
