<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Company;
use App\Models\Country;
use App\Models\Address;
use App\Models\City;
use App\Models\State;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $sessionid = session()->getId();

        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user() && Auth::user()->is_admin == 0)
        {
            // Auth::guard('admin')->logout();
            $order_id = session('order_id');
            if ($order_id)
            {        
                $order = Order::find($order_id);
                $cart = $order->cart;
            }
            else
            {
                $order = NULL;
            }
    
            $cart = Cart::mergeCart($sessionid);
            $companies = Company::all();
            $user = User::find(Auth::id());
            $countries = Country::all();
            $orders = Order::all()->sortByDesc('date');
            if (Str::contains(url()->previous(), 'checkout'))
            {
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
                
                $title = 'Checkout';
                return view('checkout', compact('cart', 'companies', 'user', 'countries', 'addresses', 'order', 'cities', 'states', 'districts', 'title'));
            }
            else
            {
                $title = 'Dashboard';
                return view('dashboard.index', compact('cart', 'companies', 'user', 'countries', 'orders', 'title'));    
            }
            // return redirect()->intended(RouteServiceProvider::HOME);
            // return redirect(RouteServiceProvider::HOME, ['$cart->quantity' => $cart->quantity]);
        }
        elseif (Auth::user() && Auth::user()->is_admin == 1)
        {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
            
            return redirect(route('admin'));
        }
        else
        {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
            
            return redirect(route('admin'));
        }
    }


    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        if (Auth::user() && Auth::user()->is_admin == 1)
        {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect(route('admin.login'));
        }
        elseif (Auth::user() && Auth::user()->is_admin == 0)
        {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect(route('home'));
        }
    }
}
