<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Company;
use App\Models\Country;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Category;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index()
    {
        $products = Product::orderBy('id')->take(3)->get();
        $blogs = Blog::orderBy('id')->take(3)->get();
        $latest_product = Product::latest()->first();
        if (Auth::user())
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
        $companies = Company::all();
        $title = 'Home';
        return view('index', compact('products', 'cart', 'companies', 'blogs', 'title', 'latest_product'));
    }

    public function about()
    {
        if (Auth::user())
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
        $companies = Company::all();
        $title = 'About';
        return view('about', compact('cart', 'companies', 'title'));
    }

    public function contact()
    {
        if (Auth::user())
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
        $companies = Company::all();
        $title = 'Contact';
        return view('contact', compact('cart', 'companies', 'title'));
    }

    public function contact_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $subject = $request->subject;
        $data = ['message' => 
            'Name: ' . $request->name . '  ' .
            'Email: ' . $request->email . '  ' .
            'Phone: ' . $request->phone . '  ' .
            'Message: ' . $request->message
        ];

        Mail::to('ageorge28@gmail.com')->send(new WelcomeMail($data, $subject));

        return redirect('/contact')->with('success', 'Mail sent');
    }

    public function dashboard()
    {
        $cart =  Cart::where('user_id', Auth::id())
                    ->where('flag', 0)
                    ->first();
        $companies = Company::all();
        $user = User::find(Auth::id());
        $countries = Country::all();
        $orders = Order::all()->sortByDesc('date');
        $title = 'Dashboard';
        return view('dashboard.index', compact('cart', 'companies', 'user', 'countries', 'orders', 'title'));
    }

    public function orders()
    {
        $cart =  Cart::where('user_id', Auth::id())
                   ->where('flag', 0)
                   ->first();
        
        if (is_null($cart))
        {
            $cart = NULL;
        }

        $companies = Company::all();
        $user = User::find(Auth::id());
        $orders = Order::where('user_id', Auth::id())->get()->sortByDesc('date');
        $title = 'Orders';

        return view('dashboard.orders', compact('orders', 'cart', 'companies', 'user', 'title'));
    }

    public function address()
    {
        $cart =  Cart::where('user_id', Auth::id())
                   ->where('flag', 0)
                   ->first();
        $companies = Company::all();
        $user = User::find(Auth::id());
        $title = 'Addresses';

        return view('dashboard.address.index', compact('cart', 'companies', 'user', 'title'));
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;

        $all_products = Product::where('name', 'LIKE', '%' . $keywords . '%')
                        ->orWhere('description', 'LIKE', '%' . $keywords . '%')
                        ->get();
        $totalcount = $all_products->count();
        $products = $all_products->paginate(6);
        if (Auth::user())
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
        $companies = Company::all();
        $categories = Category::all();
        $filter_all = true;
        $filters = [0];
        $sort = 'asc';
        $title = 'title';
        return view('search', compact('products', 'cart', 'companies', 'categories', 'keywords', 'filters', 'filter_all', 'sort', 'totalcount', 'title'));
    }

    public function filter(Request $request)
    {
        $keywords = $request->keywords;
        $sort = $request->sort;
        $categories = Category::all();
        $category_filters = $request->categories;

        $filters = ($category_filters[0] == 0) ? $categories->pluck('id')->toArray() : $request->categories;

        $search_products = Product::where('name', 'LIKE', '%' . $keywords . '%')
                                   ->orWhere('description', 'LIKE', '%' . $keywords . '%')
                                   ->get();

        $filtered_products = $search_products->whereIn('category_id', $filters);

        if ($sort == 'desc')
        {
            $final_products = $filtered_products->sortByDesc('price', SORT_NUMERIC);
        }
        else
        {
            $final_products = $filtered_products->sortBy('price', SORT_NUMERIC);
        }

        $products = $final_products->paginate(6);

        $totalcount = $final_products->count();

        if ($category_filters[0] == 0)
        {
            $filter_all = true;
            $filters = [0];
        } 
        else
        {
            $filter_all = false;
        }

        if (Auth::user())
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
        $companies = Company::all();
        $categories = Category::all();
        $title = 'title';
        return view('search', compact('products', 'cart', 'companies', 'categories', 'keywords', 'filters', 'filter_all', 'sort', 'category_filters', 'totalcount', 'title'));
    }

}
