<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Company;
use App\Models\Image;
use App\Models\File;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::paginate(3);
        $totalcount = Blog::all()->count();
        $companies = Company::all();
        $title = 'Blog';
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
        return view('blog.index', compact('blogs', 'companies', 'cart', 'totalcount', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_categories = BlogCategory::all();
        return view('admin.blogs.create', compact('blog_categories'));;
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
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'blog_category' => 'required'
        ]);     

        $blog = new Blog();
        $blog->user_id = Auth::id();
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->description = $request->description;
        $blog->date = Carbon::now()->format('Y-m-d');

        $image = new Image();
        $image->filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $image->filename);
        $image->save();
        
        $blog->image_id = $image->id;
        $blog->category_id = $request->blog_category;

        $blog->save();

        return redirect('/admin/blogs')->with('success', 'Blog Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $blogs = Blog::all();
        $blogcategories = BlogCategory::all();
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
        $title = $blog->title;
        return view('blog.show', compact('blog', 'blogs', 'cart', 'companies', 'blogcategories', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $blog_categories = BlogCategory::all();
        return view('admin.blogs.edit', compact('blog', 'blog_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'description' => 'required',
            'blog_category' => 'required'
        ]);     

        $blog->user_id = Auth::id();
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->description = $request->description;
        $blog->date = Carbon::now()->format('Y-m-d');

        if ($request->hasFile('image'))
        {
            $image = Image::find($blog->image_id);
            if(File::exists(public_path('uploads/' . $image->filename)))
            {
                File::delete(public_path('uploads/' . $image->filename));
            }
            $image->filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $image->filename);
            $image->save();
        }
        
        $blog->category_id = $request->blog_category;

        $blog->save();

        return redirect('/admin/blogs')->with('success', 'Blog Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $image = $blog->image;
        if(File::exists(public_path('uploads/' . $image->filename)))
        {
            File::delete(public_path('uploads/' . $image->filename));
        }
        $image->delete();
        $blog->delete();

        return redirect('/admin/blogs')->with('success', 'Blog Deleted');
    }

    public function searchbycategory($category)
    {
        $blogcategoryname = Str::title(str_replace('-', ' ', $category));
        $blogcategory = BlogCategory::where('name', $blogcategoryname)->first();

        $blogs = $blogcategory->blogs()->paginate(3);
        $totalcount = $blogcategory->blogs()->count();

        
        $companies = Company::all();
        $title = 'Blog';

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
        return view('blog.search', compact('blogs', 'companies', 'cart', 'totalcount', 'title'));
    }

    public function searchbytag($tag)
    {
        $blogtag = Tag::where('name', $tag)->first();

        $blogs = $blogtag->blogs()->paginate(3);   

        $totalcount = $blogtag->blogs()->count();

        $companies = Company::all();
        $title = 'Blog';

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
        return view('blog.search', compact('blogs', 'companies', 'cart', 'totalcount', 'title'));
    }

}
