<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
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
        return view('admin.companies.create');
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $company = new Company();
        $company->name = $request->name;

        $image = new Image();
        $image->filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $image->filename);
        $image->save();
        
        $company->image_id = $image->id;
        $company->save();

        return redirect('/admin/companies')->with('success', 'Company Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
             
        $company->name = $request->name;

        if ($request->hasFile('image'))
        {
            $image = Image::find($company->image_id);
            if(File::exists(public_path('uploads/' . $image->filename)))
            {
                File::delete(public_path('uploads/' . $image->filename));
            }
            $image->filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $image->filename);
            $image->save();
        }
 
        $company->save();

        return redirect('/admin/companies')->with('success', 'Company Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $image = $company->image;
        if(File::exists(public_path('uploads/' . $image->filename)))
        {
            File::delete(public_path('uploads/' . $image->filename));
        }
        $image->delete();
        $company->delete();

        return redirect('/admin/companies')->with('success', 'Company Deleted');
    }
}
