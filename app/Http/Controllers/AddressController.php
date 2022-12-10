<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Address;
use App\Models\Company;
use App\Models\Country;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
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
        $cart =  Cart::where('user_id', Auth::id())
                   ->where('flag', 0)
                   ->first();
        $companies = Company::all();
        $user = User::find(Auth::id());
        $countries = Country::all();
        $cities = City::all()->sortBy('name');
        $states = State::all()->sortBy('state_title');
        $districts = District::all()->sortBy('district_title');
        $title = 'Addresses';
        return view('dashboard.address.create', compact('cart', 'companies', 'user', 'countries', 'cities', 'states', 'districts', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' =>'required|max:255',
            'contact_phone' => 'required|min:10',
            'address1' =>'required|max:255',
            'city' =>'required|max:255',
            'district' =>'required|max:255',
            'state' =>'required|max:255'
        ]);

        $address = new Address();
        $address->user_id = Auth::id();
        $address->description = $request->description;
        $address->name = $request->contact_person;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->landmark = $request->landmark;
        $address->phone = $request->contact_phone;
        $address->district = $request->district;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;

        $address->save();

        // $cart =  Cart::where('user_id', Auth::id())
        //             ->where('flag', 0)
        //             ->first();
        // $companies = Company::all();
        // $user = User::find(Auth::id());

        return redirect('/dashboard/addresses')->with('success', 'Address Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        $cart =  Cart::where('user_id', Auth::id())
                ->where('flag', 0)
                ->first();
        $companies = Company::all();
        $user = User::find(Auth::id());
        $countries = Country::all();
        $cities = City::all()->sortBy('name');
        $states = State::all()->sortBy('state_title');
        $districts = District::all()->sortBy('district_title');
        $title = 'Addresses';
        return view('dashboard.address.edit', compact('cart', 'companies', 'user', 'countries', 'address', 'cities', 'states', 'districts', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        
        $request->validate([
            'description' =>'required|max:255',
            'contact_phone' => 'required|min:10',
            'address1' =>'required|max:255',
            'city' =>'required|max:255',
            'district' =>'required|max:255',
            'state' =>'required|max:255'
        ]);

        $address->description = $request->description;
        $address->name = $request->contact_person;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->landmark = $request->landmark;
        $address->phone = $request->contact_phone;
        $address->district = $request->district;
        $address->city = $request->city;
        $address->state = $request->state;

        $address->save();

        // $cart =  Cart::where('user_id', Auth::id())
        //             ->where('flag', 0)
        //             ->first();
        // $companies = Company::all();
        // $user = User::find(Auth::id());

        return redirect('/dashboard/addresses')->with('success', 'Address Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return redirect('/dashboard/addresses')->with('success', 'Address Deleted');
    }
}
