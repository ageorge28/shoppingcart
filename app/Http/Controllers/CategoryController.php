<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
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
    public function create()
    {
        return view('admin.categories.create');
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
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        $image = new Image();
        $image->filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $image->filename);
        $image->save();
        
        $category->image_id = $image->id;

        $category->save();

        return redirect('/admin/categories')->with('success', 'Category Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);     

        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image'))
        {
            $image = Image::find($category->image_id);
            if(File::exists(public_path('uploads/' . $image->filename)))
            {
                File::delete(public_path('uploads/' . $image->filename));
            }
            $image->filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $image->filename);
            $image->save();
        }
 
        $category->save();

        return redirect('/admin/categories')->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $image = $category->image;
        if(File::exists(public_path('uploads/' . $image->filename)))
        {
            File::delete(public_path('uploads/' . $image->filename));
        }
        $image->delete();
        $category->delete();

        return redirect('/admin/categories')->with('success', 'Category Deleted');
    }
}
