@extends('dashboard.layouts.app')

@section('dashboard')

  <div class="col-lg-2 mb-5">
    @include('dashboard.layouts.navigation')
  </div>

  <div class="col-lg-10">
    <div class="cart-table-wrap">
      <table class="cart-table">
        <thead class="cart-table-head">
          <tr class="table-head-row">
            <th class="product-image">Type</th>
            <th class="product-name">Name</th>
            <th class="product-price">Phone</th>
            <th class="product-quantity">Address Line 1</th>
            <th class="product-total">Address Line 2</th>
            <th class="product-total">City</th>
            <th class="product-total" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->addresses as $address)
            <tr class="table-body-row">
              <td class="product-name">{{ $address->description }}</td>
              <td class="product-name">{{ $address->name }}</td>
              <td class="product-price">{{ $address->phone }}</td>
              <td class="product-image text-wrap">{{ $address->address1 }}</td>
              <td class="product-image text-wrap">{{ $address->address2 }}</td>
              <td class="product-total">{{ $address->city }}</td>
              <td class="product-total">
                <a href="{{ route('address.edit', ['address' => $address->id]) }}" class="btn btn-success btn-sm">Edit</a>
                <form style="all:unset" action="{{ route('address.delete', ['address' => $address->id]) }}" method="post">                  
                  @csrf                  
                  @method('DELETE')                  
                  <button class="btn btn-danger btn-sm" type="submit">Delete</button>                
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <br />
    <p>
      <a href="{{ route('address.create') }}" class="shopping-btn">Add Address</a>
    </p>

  </div>

@endsection