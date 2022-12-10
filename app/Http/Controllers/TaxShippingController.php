<?php

namespace App\Http\Controllers;

use App\Models\TaxShipping;
use Illuminate\Http\Request;

class TaxShippingController extends Controller
{
    public function index()
    {

    }

    public function edit()
    {
        $taxshipping = TaxShipping::first();
        return view('admin.taxshipping.edit', compact('taxshipping'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'tax' => 'required',
            'shipping' => 'required'
        ]);

        $taxshipping = TaxShipping::first();
        $taxshipping->tax = $request->tax;
        $taxshipping->shipping = $request->shipping;
        $taxshipping->save();
        
        return redirect('/admin/taxshipping')->with('success', 'Tax and Shipping Updated');
    }
}
