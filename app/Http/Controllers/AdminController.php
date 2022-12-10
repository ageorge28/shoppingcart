<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\TaxShipping;
use App\Models\Coupon;
use App\Models\Status;
use App\Models\Company;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AdminController extends Controller
{
    public function index()
    { 
        $orders = Order::where('flag', true)->get();
        $total = 0;
        foreach($orders as $order)
        {
            $total += $order->cart->total;
        }

        $products = Product::all()->count();

        if (Auth::user() && Auth::user()->is_admin == 1)
        {
            return view('admin.index', compact('orders', 'total', 'products'));
        }
        else
        {
            return view('admin.login');
        }
    }

    public function create()
    {
        return view('admin.login');
    }

    public function store(LoginRequest $request)
    {
        $sessionid = session()->getId();

        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user() && Auth::user()->is_admin == 0)
        {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
            
            return redirect('/login');
        }
        else
        {
            return redirect('/admin');
        }
    }


    public function categories()
    {        
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function products()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function carts()
    {
        $carts = Cart::all();
        return view('admin.carts.index', compact('carts'));
    }

    public function orders()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function coupons()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function companies()
    {
        $companies = Company::all();
        return view('admin.companies.index', compact('companies'));
    }

    public function statuses()
    {
        $statuses = Status::all();
        return view('admin.statuses.index', compact('statuses'));
    }

    public function blogs()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function blogcategories()
    {
        $blogcategories = BlogCategory::all();
        return view('admin.blogcategories.index', compact('blogcategories'));
    }

    public function taxshipping()
    {
        $taxshipping = TaxShipping::first();
        return view('admin.taxshipping.index', compact('taxshipping'));
    }
}
