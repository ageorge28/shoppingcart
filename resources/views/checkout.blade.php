@extends('layouts.app')

@section('content')

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Check Out</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->


    <!-- check out section -->
    <div class="checkout-section mt-100 mb-100">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">

                @if ($cart->is_guest == 0)
                    <div class="col-lg-9">
                        <form method="POST" action="{{ route('order.store') }}" style="all:unset">
                            @csrf

                            <input type="hidden" name="order_id" id="order_id"
                                value="{{ !is_null($order) ? $order->id : '' }}" />

                            <input type="hidden" name="is_guest" id="is_guest" value="0" />

                            <div class="checkout-accordion-wrap">
                                <div class="accordion" id="accordionExample">
                                    <div class="card single-accordion">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" style="padding-left:25px" type="button"
                                                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <span style="color: #F28123"
                                                        class="fa fa-arrow-circle-right">&nbsp;&nbsp;</span>Shipping Address
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shipping-address-form">

                                                    @foreach ($addresses as $address)
                                                        <div class="row mb-2">
                                                            <div class="col-sm-1">
                                                                <input type="radio" name="selected_shipping_address"
                                                                    value="{{ $address->id }}"
                                                                    {{ !is_null($order) && $order->shipping_address_id == $address->id ? ' checked' : '' }} />
                                                            </div>
                                                            <div class="col-sm-1">
                                                                {{ $address->description }}
                                                            </div>
                                                            <div class="col-sm-1">
                                                                {{ $address->name }} <br />
                                                            </div>
                                                            <div class="col-sm-2">
                                                                {{ $address->phone }} <br />
                                                            </div>
                                                            <div class="col-lg">
                                                                {{ $address->address1 }} <br />
                                                                {{ $address->address2 }} <br />
                                                            </div>
                                                            <div class="col-sm-2">
                                                                {{ $address->city }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="row mb-2">
                                                        <div class="col-sm-1">
                                                            <input type="radio" name="selected_shipping_address"
                                                                value="0" />
                                                        </div>
                                                        <div class="col-sm-2">
                                                            Others
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="shipping-address-form d-none" id="shipping_address_form">

                                                    {{-- <form method="POST" action="/dashboard/address/store">
									
                                        @csrf --}}

                                                    <div class="form-group fieldGroup">

                                                        <div class="form-group row mb-2">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="description"
                                                                            class="form-label">Address Type: </label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <input class="form-control" type="text"
                                                                            placeholder="Address Type (Home, Office, etc.)"
                                                                            name="shipping_description"
                                                                            id="shipping_description">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="contact_person"
                                                                            class="">Contact Person: </label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <input class="form-control" type="text"
                                                                            placeholder="Contact Person"
                                                                            name="shipping_contact_person"
                                                                            id="shipping_contact_person">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-2">
                                                            <div class="col-2">
                                                                <label for="shipping_address1"
                                                                    class="">Address Line 1: </label>
                                                            </div>
                                                            <div class="col-10">
                                                                <input class="form-control" type="text"
                                                                    placeholder="Address Line 1" name="shipping_address1"
                                                                    id="shipping_address1" value="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-2">
                                                            <div class="col-2">
                                                                <label for="address2" class="">Address Line 2:
                                                                </label>
                                                            </div>
                                                            <div class="col-10">
                                                                <input class="form-control" type="text"
                                                                    placeholder="Address Line 2" name="shipping_address2"
                                                                    id="shipping_address2" value="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-2">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="landmark"
                                                                            class="form-label">Landmark: </label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <input class="form-control" type="text"
                                                                            placeholder="Landmark" name="shipping_landmark"
                                                                            id="shipping_landmark">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="contact_phone"
                                                                            class="">Contact Phone: </label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <input class="form-control" type="text"
                                                                            placeholder="Contact Phone"
                                                                            name="shipping_contact_phone"
                                                                            id="shipping_contact_phone">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-2">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="shipping_city"
                                                                            class="">City: </label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <select id="shipping_city" name="shipping_city"
                                                                            class="form-control">
                                                                            <option value="0">-- Select City --</option>
                                                                            @foreach ($cities as $city)
                                                                                <option value="{{ $city->name }}">
                                                                                    {{ $city->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="shipping_district"
                                                                            class="form-label">District: </label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <select id="shipping_district"
                                                                            name="shipping_district" class="form-control">
                                                                            <option value="0">-- Select District --</option>
                                                                            @foreach ($districts as $district)
                                                                                <option
                                                                                    value="{{ $district->district_title }}">
                                                                                    {{ $district->district_title }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-2">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="shipping_state"
                                                                            class="">State: </label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <select id="shipping_state" name="shipping_state"
                                                                            class="form-control">
                                                                            <option value="0">-- Select State --</option>
                                                                            @foreach ($states as $state)
                                                                                <option
                                                                                    value="{{ $state->state_title }}">
                                                                                    {{ $state->state_title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label for="shipping_country"
                                                                            class="">Country: </label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <select id="shipping_country"
                                                                            name="shipping_country" class="form-control">
                                                                            <option value="0">-- Select Country --</option>
                                                                            @foreach ($countries as $country)
                                                                                <option
                                                                                    value="{{ $country->country_name }}"
                                                                                    {{ $country->country_name == 'India' ? ' selected' : '' }}>
                                                                                    {{ $country->country_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    {{-- <div class="row">
                                            <input class="pt-2 pb-2 w-25" style="font-size:12px; color:#fff" type="submit" value="Save"></p>
                                        </div>

                                    </form> --}}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card single-accordion mb-5">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" style="padding-left:25px"
                                                    type="button" data-toggle="collapse" data-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    <span style="color: #F28123"
                                                        class="fa fa-arrow-circle-right">&nbsp;&nbsp;</span>Billing Address
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="billing-address-form">
                                                    <div class="form-check" style="padding-left:0">
                                                        <input class="mt-4 mb-4" class="form-check-input"
                                                            type="checkbox" name="same" id="same"
                                                            {{ !is_null($order) && $order->shipping_address_id == $order->billing_address->id ? ' checked' : '' }} />&nbsp;
                                                        Same as Shipping Address
                                                    </div>
                                                    <div class="address-form">
                                                        @foreach ($addresses as $address)
                                                            <div class="row mb-2">
                                                                <div class="col-sm-1">
                                                                    <input type="radio" name="selected_billing_address"
                                                                        value="{{ $address->id }}"
                                                                        {{ !is_null($order) && $order->billing_address_id == $address->id ? ' selected' : '' }} />
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    {{ $address->description }}
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    {{ $address->name }} <br />
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    {{ $address->phone }} <br />
                                                                </div>
                                                                <div class="col-lg">
                                                                    {{ $address->address1 }} <br />
                                                                    {{ $address->address2 }} <br />
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    {{ $address->city }}
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="row mb-2">
                                                            <div class="col-sm-1">
                                                                <input type="radio" name="selected_billing_address"
                                                                    value="0" />
                                                            </div>
                                                            <div class="col-sm-2">
                                                                Others
                                                            </div>
                                                        </div>


                                                        <div class="billing-address-form d-none" id="billing_address_form">

                                                            {{-- <form method="POST" action="/dashboard/address/store">
                                
                                    @csrf --}}

                                                            <div class="form-group fieldGroup">

                                                                <div class="form-group row mb-2">
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="billing_description"
                                                                                    class="form-label">Address Type:
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <input class="form-control" type="text"
                                                                                    placeholder="Address Type (Home, Office, etc.)"
                                                                                    name="billing_description"
                                                                                    id="billing_description">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="contact_person"
                                                                                    class="">Contact Person:
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <input class="form-control" type="text"
                                                                                    placeholder="Contact Person"
                                                                                    name="billing_contact_person"
                                                                                    id="billing_contact_person">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mb-2">
                                                                    <div class="col-2">
                                                                        <label for="address1"
                                                                            class="">Address Line 1: </label>
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <input class="form-control" type="text"
                                                                            placeholder="Address Line 1"
                                                                            name="billing_address1" id="billing_address1"
                                                                            value="">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mb-2">
                                                                    <div class="col-2">
                                                                        <label for="address2"
                                                                            class="">Address Line 2: </label>
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <input class="form-control" type="text"
                                                                            placeholder="Address Line 2"
                                                                            name="billing_address2" id="billing_address2"
                                                                            value="">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mb-2">
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="landmark"
                                                                                    class="form-label">Landmark:
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <input class="form-control" type="text"
                                                                                    placeholder="Landmark"
                                                                                    name="billing_landmark"
                                                                                    id="billing_landmark">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="contact_phone"
                                                                                    class="">Contact Phone:
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <input class="form-control" type="text"
                                                                                    placeholder="Contact Phone"
                                                                                    name="billing_contact_phone"
                                                                                    id="billing_contact_phone">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mb-2">
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="billing_city"
                                                                                    class="">City: </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <select id="billing_city"
                                                                                    name="billing_city"
                                                                                    class="form-control">
                                                                                    <option value="0">-- Select City --
                                                                                    </option>
                                                                                    @foreach ($cities as $city)
                                                                                        <option
                                                                                            value="{{ $city->name }}">
                                                                                            {{ $city->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="billing_district"
                                                                                    class="form-label">District:
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <select id="billing_district"
                                                                                    name="billing_district"
                                                                                    class="form-control">
                                                                                    <option value="0">-- Select District --
                                                                                    </option>
                                                                                    @foreach ($districts as $district)
                                                                                        <option
                                                                                            value="{{ $district->district_title }}">
                                                                                            {{ $district->district_title }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mb-2">
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="billing_state"
                                                                                    class="">State: </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <select id="billing_state"
                                                                                    name="billing_state"
                                                                                    class="form-control">
                                                                                    <option value="0">-- Select State --
                                                                                    </option>
                                                                                    @foreach ($states as $state)
                                                                                        <option
                                                                                            value="{{ $state->state_title }}">
                                                                                            {{ $state->state_title }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="country"
                                                                                    class="">Country:
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <select id="billing_country"
                                                                                    name="billing_country"
                                                                                    class="form-control">
                                                                                    <option value="0">-- Select Country --
                                                                                    </option>
                                                                                    @foreach ($countries as $country)
                                                                                        <option
                                                                                            value="{{ $country->country_name }}"
                                                                                            {{ $country->country_name == 'India' ? ' selected' : '' }}>
                                                                                            {{ $country->country_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="row">
                                        <input class="pt-2 pb-2 w-25" style="font-size:12px; color:#fff" type="submit" value="Save"></p>
                                    </div>

                                    </form> --}}

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <a href="{{ route('cart') }}" class="boxed-btn">Go Back</a>
                            <button id="place-order" type="submit" class="boxed-btn">Place Order</button>

                        </form>
                    </div>
                @else
                    <div class="col-lg-6">

                        <form method="POST" action="{{ route('order.store') }}" style="all:unset">

                            @csrf

                            <input type="hidden" name="order_id" id="order_id"
                                value="{{ !is_null($order) ? $order->id : '' }}" />
                            <input type="hidden" name="is_guest" id="is_guest" value="1" />
                            <input type="hidden" name="selected_shipping_address" value="0" />
                            <input type="hidden" name="selected_billing_address" value="0" />

                            <div class="card">
                                <div class="card-header" style="background-color: #EFEFEF; border:0">
                                    <h5 style="padding:13px">Checkout As Guest</h5>
                                </div>
                                <div class="card-body">
                                    <div class=" row mt-2 mb-4">


                                        <div class="form-group row mb-4">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label for="name" class="form-label">Name: </label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" placeholder="Name"
                                                            name="name" id="name" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label for="phone">Phone: </label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" placeholder="Phone"
                                                            name="phone" id="phone">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <div class="col-2">
                                                <label for="email" class="form-label">Email: </label>
                                            </div>
                                            <div class="col-10">
                                                <input class="form-control" type="email" placeholder="Email" name="email"
                                                    id="email" />
                                            </div>
                                        </div>


                                    </div>

                                    <div class="checkout-accordion-wrap">
                                        <div class="accordion" id="accordionExample">
                                            <div class="card single-accordion">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" style="padding-left:25px"
                                                            type="button" data-toggle="collapse" data-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            <span style="color: #F28123"
                                                                class="fa fa-arrow-circle-right">&nbsp;&nbsp;</span>Shipping
                                                            Address
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="shipping-address-form" id="shipping_address_form">

                                                            {{-- <form method="POST" action="/dashboard/address/store">
									
                                        @csrf --}}

                                                            <div class="form-group fieldGroup">

                                                                <div class="form-group row mb-2">
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="description"
                                                                                    class="form-label">Address Type:
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <input class="form-control" type="text"
                                                                                    placeholder="Address Type (Home, Office, etc.)"
                                                                                    name="shipping_description"
                                                                                    id="shipping_description">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="contact_person"
                                                                                    class="">Contact Person:
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <input class="form-control" type="text"
                                                                                    placeholder="Contact Person"
                                                                                    name="shipping_contact_person"
                                                                                    id="shipping_contact_person">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mb-2">
                                                                    <div class="col-2">
                                                                        <label for="address1"
                                                                            class="">Address Line 1: </label>
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <input class="form-control" type="text"
                                                                            placeholder="Address Line 1"
                                                                            name="shipping_address1" id="shipping_address1"
                                                                            value="">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mb-2">
                                                                    <div class="col-2">
                                                                        <label for="address2"
                                                                            class="">Address Line 2: </label>
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <input class="form-control" type="text"
                                                                            placeholder="Address Line 2"
                                                                            name="shipping_address2" id="shipping_address2"
                                                                            value="">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mb-2">
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="shipping_landmark"
                                                                                    class="form-label">Landmark:
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <input class="form-control" type="text"
                                                                                    placeholder="Landmark"
                                                                                    name="shipping_landmark"
                                                                                    id="shipping_landmark">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="contact_phone"
                                                                                    class="">Contact Phone:
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <input class="form-control" type="text"
                                                                                    placeholder="Contact Phone"
                                                                                    name="shipping_contact_phone"
                                                                                    id="shipping_contact_phone">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mb-2">
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="shipping_city"
                                                                                    class="">City: </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <select id="shipping_city"
                                                                                    name="shipping_city"
                                                                                    class="form-control">
                                                                                    <option value="0">-- Select City --
                                                                                    </option>
                                                                                    @foreach ($cities as $city)
                                                                                        <option
                                                                                            value="{{ $city->name }}">
                                                                                            {{ $city->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="shipping_district"
                                                                                    class="form-label">District:
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <select id="shipping_district"
                                                                                    name="shipping_district"
                                                                                    class="form-control">
                                                                                    <option value="0">-- Select District --
                                                                                    </option>
                                                                                    @foreach ($districts as $district)
                                                                                        <option
                                                                                            value="{{ $district->district_title }}">
                                                                                            {{ $district->district_title }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row mb-2">
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="shipping_state"
                                                                                    class="">State: </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <select id="shipping_state"
                                                                                    name="shipping_state"
                                                                                    class="form-control">
                                                                                    <option value="0">-- Select State --
                                                                                    </option>
                                                                                    @foreach ($states as $state)
                                                                                        <option
                                                                                            value="{{ $state->state_title }}">
                                                                                            {{ $state->state_title }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label for="shipping_country"
                                                                                    class="">Country:
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-8">
                                                                                <select id="shipping_country"
                                                                                    name="shipping_country"
                                                                                    class="form-control">
                                                                                    <option value="0">-- Select Country --
                                                                                    </option>
                                                                                    @foreach ($countries as $country)
                                                                                        <option
                                                                                            value="{{ $country->country_name }}"
                                                                                            {{ $country->country_name == 'India' ? ' selected' : '' }}>
                                                                                            {{ $country->country_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            {{-- <div class="row">
                                            <input class="pt-2 pb-2 w-25" style="font-size:12px; color:#fff" type="submit" value="Save"></p>
                                        </div>

                                    </form> --}}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card single-accordion">
                                                <div class="card-header" id="headingTwo">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" style="padding-left:25px"
                                                            type="button" data-toggle="collapse" data-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                            <span style="color: #F28123"
                                                                class="fa fa-arrow-circle-right">&nbsp;&nbsp;</span>Billing
                                                            Address
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            <input class="mt-4 mb-4" class="form-check-input"
                                                                type="checkbox" name="same" id="same"
                                                                {{ !is_null($order) && $order->shipping_address_id == $order->billing_address->id ? ' checked' : '' }} />&nbsp;
                                                            Same as Shipping Address
                                                        </div>

                                                        <div class="billing-address-form" id="billing_address_form">

                                                            {{-- <form method="POST" action="/dashboard/address/store">
                                
                                    @csrf --}}
                                                            <div class="address-form">
                                                                <div class="form-group fieldGroup">

                                                                    <div class="form-group row mb-2">
                                                                        <div class="col">
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <label for="description"
                                                                                        class="form-label">Address
                                                                                        Type: </label>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        placeholder="Address Type (Home, Office, etc.)"
                                                                                        name="billing_description"
                                                                                        id="billing_description">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <label for="contact_person"
                                                                                        class="">Contact
                                                                                        Person: </label>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        placeholder="Contact Person"
                                                                                        name="billing_contact_person"
                                                                                        id="billing_contact_person">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row mb-2">
                                                                        <div class="col-2">
                                                                            <label for="billing_address1"
                                                                                class="">Address Line 1:
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-10">
                                                                            <input class="form-control" type="text"
                                                                                placeholder="Address Line 1"
                                                                                name="billing_address1"
                                                                                id="billing_address1" value="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row mb-2">
                                                                        <div class="col-2">
                                                                            <label for="address2"
                                                                                class="">Address Line 2:
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-10">
                                                                            <input class="form-control" type="text"
                                                                                placeholder="Address Line 2"
                                                                                name="billing_address2"
                                                                                id="billing_address2" value="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row mb-2">
                                                                        <div class="col">
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <label for="landmark"
                                                                                        class="form-label">Landmark:
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <input class="form-control"
                                                                                        type="text" placeholder="Landmark"
                                                                                        name="billing_landmark"
                                                                                        id="billing_landmark">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <label for="contact_phone"
                                                                                        class="">Contact
                                                                                        Phone: </label>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        placeholder="Contact Phone"
                                                                                        name="billing_contact_phone"
                                                                                        id="billing_contact_phone">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row mb-2">
                                                                        <div class="col">
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <label for="billing_city"
                                                                                        class="">City:
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <select id="billing_city"
                                                                                        name="billing_city"
                                                                                        class="form-control">
                                                                                        <option value="0">-- Select City --
                                                                                        </option>
                                                                                        @foreach ($cities as $city)
                                                                                            <option
                                                                                                value="{{ $city->name }}">
                                                                                                {{ $city->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <label for="billing_district"
                                                                                        class="form-label">District:
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <select id="billing_district"
                                                                                        name="billing_district"
                                                                                        class="form-control">
                                                                                        <option value="0">-- Select District
                                                                                            --</option>
                                                                                        @foreach ($districts as $district)
                                                                                            <option
                                                                                                value="{{ $district->district_title }}">
                                                                                                {{ $district->district_title }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row mb-2">
                                                                        <div class="col">
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <label for="billing_state"
                                                                                        class="">State:
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <select id="billing_state"
                                                                                        name="billing_state"
                                                                                        class="form-control">
                                                                                        <option value="0">-- Select State --
                                                                                        </option>
                                                                                        @foreach ($states as $state)
                                                                                            <option
                                                                                                value="{{ $state->state_title }}">
                                                                                                {{ $state->state_title }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <label for="country"
                                                                                        class="">Country:
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <select id="billing_country"
                                                                                        name="billing_country"
                                                                                        class="form-control">
                                                                                        <option value="0">-- Select Country
                                                                                            --</option>
                                                                                        @foreach ($countries as $country)
                                                                                            <option
                                                                                                value="{{ $country->country_name }}"
                                                                                                {{ $country->country_name == 'India' ? ' selected' : '' }}>
                                                                                                {{ $country->country_name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- <div class="row">
                                        <input class="pt-2 pb-2 w-25" style="font-size:12px; color:#fff" type="submit" value="Save"></p>
                                    </div>

                                    </form> --}}

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="row mt-4 mb-4 ml-2">
                                    <div class="col-sm-5">
                                        <a href="{{ route('cart') }}" class="boxed-btn">Go Back</a>
                                        <button id="place-order" type="submit" class="boxed-btn">Place Order</button>
                                    </div>
                                </div>
                                {{-- </form> --}}
                            </div>
                    </div>
                    </form>
                    <div class="col-lg-3">

                        <div class="card">
                            <div class="card-header" style="background-color: #EFEFEF; border:0">
                                <h5 style="padding:13px">Login</h5>
                            </div>
                            <div class="card-body">

                                <x-guest-layout>


                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <!-- Email Address -->
                                        <div>
                                            <x-label for="email" :value="__('Email')" />

                                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                                :value="old('email')" required autofocus />
                                        </div>

                                        <!-- Password -->
                                        <div class="mt-4">
                                            <x-label for="password" :value="__('Password')" />

                                            <x-input id="password" class="block mt-1 w-full" type="password"
                                                name="password" required autocomplete="current-password" />
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="block mt-4">
                                            <label for="remember_me" class="inline-flex items-center">
                                                <input id="remember_me" type="checkbox"
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    name="remember">
                                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                            @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                            @endif

                                            <x-button class="ml-2">
                                                {{ __('Log in') }}
                                            </x-button>

                                            <x-button class="ml-2">
                                                {{ __('Register') }}
                                            </x-button>

                                        </div>
                                    </form>

                                </x-guest-layout>
                            </div>
                        </div>



                    </div>
                @endif

                <div class="col-lg-3">
                    <div class="order-details-wrap">
                        <table class="order-details w-100">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="order-details-body">
                                @foreach ($cart->products as $cart_product)
                                    <tr>
                                        <td>{{ $cart_product->product->name }}</td>
                                        <td>₹{{ $cart_product->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody class="checkout-details">
                                <tr>
                                    <td>Subtotal</td>
                                    <td>₹{{ $cart->subtotal }}</td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td>₹{{ !is_null($cart->coupon) ? ($cart->subtotal * $cart->coupon->discount) / 100 : 0 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>₹{{ $cart->shipping }}</td>
                                </tr>
                                <tr>
                                    <td>Tax</td>
                                    <td>₹{{ !is_null($cart->tax) ? $cart->tax : '0.0' }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>₹{{ $cart->total }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br />
                        {{-- <a href="/cart" class="boxed-btn">Go Back</a>
						<button id="place-order" type="submit" class="boxed-btn">Place Order</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end check out section -->
    </form>

@endsection
