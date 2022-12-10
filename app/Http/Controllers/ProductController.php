<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Company;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(6);
        $totalcount = Product::all()->count();
        $categories = Category::all();
        $category = NULL;
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
        $title = 'Shop';
        return view('products.index', compact('products', 'categories', 'category', 'cart', 'companies', 'totalcount', 'title'));
    }

    public function category($slug)
    {
        $categoryname = Str::title(str_replace('-', ' ', $slug));
        $category = Category::where('name', $categoryname)->first();
        $unpaginated_products = Product::where('category_id', $category->id)
                                    ->get();

        $products = $unpaginated_products->paginate(6);
        $totalcount = Product::all()->count();
        $categories = Category::all();
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
        $title = 'Shop';
        return view('products.index', compact('products', 'categories', 'category', 'cart', 'companies', 'title', 'totalcount'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required',
            'quantity' => 'required|numeric|min:1|max:500',
            'price' => 'required',
        ]);     

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;

        $image = new Image();
        $image->filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $image->filename);
        $image->save();
        
        $product->image_id = $image->id;
        $product->category_id = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;

        $product->save();

        return redirect('/admin/products')->with('success', 'Product Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $productname = Str::title(str_replace('-', ' ', $slug));
        $product = Product::where('name', $productname)->first();
        $products = Product::where('category_id', $product->category_id)
                                    ->whereNotIn('id', [$product->id])
                                    ->get();
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
        $title = $productname;                           
        return view('products.show', compact('product', 'products', 'cart', 'companies', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required',
            'quantity' => 'required|numeric|min:1|max:500',
            'price' => 'required',
        ]);     

        $product->name = $request->name;
        $product->description = $request->description;

        if ($request->hasFile('image'))
        {
            $image = Image::find($product->image_id);
            if(File::exists(public_path('uploads/' . $image->filename)))
            {
                File::delete(public_path('uploads/' . $image->filename));
            }
            $image->filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $image->filename);
            $image->save();
        }
        
        $product->category_id = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;

        $product->save();

        return redirect('/admin/products')->with('success', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $image = $product->image;
        if(File::exists(public_path('uploads/' . $image->filename)))
        {
            File::delete(public_path('uploads/' . $image->filename));
        }
        $image->delete();
        $product->delete();

        return redirect('/admin/products')->with('success', 'Product Deleted');
    }
}
