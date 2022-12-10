@extends('layouts.app')

@section('content')

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg" style="padding: 50px 0 !important">
		<div class="container">
			<div class="row">
				{{-- <div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>We sale fresh fruits</p>
						<h1>Dashboard</h1>
					</div>
				</div> --}}
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- team section -->
	<div class="mt-100 mb-100">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					@if(session()->get('error'))
						<div class="alert alert-danger">
							{{ session()->get('error') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div><br /></div>
					@endif 	
					<div class="section-title">
						<h3>Dashboard</span></h3>
					</div>
				</div>

				<div class="col-lg-12">
					<div>
						@if ($message = session()->get('success'))
							<div class="alert alert-success">{{ $message }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
							</div>
						@endif
					</div>
				</div>


				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-2">
						  <div class="list-group" id="list-tab" role="tablist">
							<a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">My Account</a>
							<a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">My Orders</a>
							<a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">My Addresses</a>
							<a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings">My Payment Options</a>
						  </div>
						</div>
						<div class="col-lg-10">
						  <div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
								
								<form method="POST" id="" action="{{ route('account') }}" enctype="multipart/form-data">
									
									@csrf

									<div class="form-group row">
											<div class="col">
												<div class="row">
													<div class="col-3">
														<label for="name" class="">Name: </label>
													</div>
													<div class="col-9">
														<input class="form-control" type="text" placeholder="Name" name="name" id="name" value="{{ $user->name }}">											
														@error('name')
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror											
													</div>
												</div>
											</div>
											<div class="col">
												<div class="row">
													<div class="col-3">
														<label for="email" class="">Email: </label>
													</div>
													<div class="col-9">
														<input class="form-control" type="email" placeholder="Email" name="email" id="email" value="{{ $user->email }}">													
														@error('email')
														<div class="alert alert-danger">{{ $message }}</div>
														@enderror											
													</div>
												</div>
											</div>
									</div>

									<div class="form-group row mt-5 mb-4">
										<div class="col">
											<div class="row">
												<div class="col-3">
													<img class="" style="height:50px" src="{{ asset('uploads/' . $user->image->filename) }}" />
												</div>
												<div class="col-9">
													<input class="form-control" type="file" name="picture" id="picture">											
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<div class="col-3">
													<label for="phone" class="">Phone: </label>
												</div>
												<div class="col-9">
													<input class="form-control" type="tel" placeholder="Phone" name="phone" id="phone" value="{{ $user->phone }}">		
													@error('phone')
														<div class="alert alert-danger">{{ $message }}</div>
													@enderror											
												</div>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<div class="col">
											<div class="row">
												<div class="col-3">
													<label for="password" class="">New Password: </label>
												</div>
												<div class="col-9">
													<input class="form-control" type="password" placeholder="New Password" name="password" id="password">													
												</div>
											</div>
										</div>	
										<div class="col">
											<div class="row">
												<div class="col-3">
													<label for="password_confirmation" class="">Confirm Password: </label>
												</div>
												<div class="col-9">
													<input class="form-control" type="password" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation">													
												</div>
											</div>
										</div>
										@error('password')
    										<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>

									<p><input class="pt-2 pb-2" style="font-size:12px; color:#fff" type="submit" value="Update"></p>
								
								</form>

							</div>

							<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
								<div class="row">
									<div><br /></div>
									<div class="col">
										<div class="checkout-accordion-wrap">
										<div class="accordion" id="accordionExample">
											@foreach($orders as $order)
												<div class="card single-accordion">
													<div class="card-header" id="headingOne"
													<h5 class="mb-0">
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
															Order Number #{{ $order->order_number . ' - ' . Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->date)->format('M d, Y H:i') }}
														</button>
													</h5>
													</div>
												</div>
													<br />
													<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
														<div class="accordion-body">

															<h6>Items</h6>
															<div class="cart-table-wrap">
																<table class="cart-table">
																	<thead class="cart-table-head">
																		<tr class="table-head-row">
																			<th class="product-image">Product</th>
																			<th class="product-name">Name</th>
																			<th class="product-price">Price</th>
																			<th class="product-quantity">Quantity</th>
																			<th class="product-total">Total</th>
																		</tr>
																	</thead>
																	<tbody>
																		@foreach($order->cart->products as $cart_product)
																			<tr class="table-body-row">
																				<td class="product-image"><img src="{{ asset('uploads') . '/' . $cart_product->product->image->filename }}" alt=""></td>
																				<td class="product-name">{{ $cart_product->product->name }}</td>
																				<td class="product-price">${{ $cart_product->product->price }}</td>
																				<td class="product-quantity">{{ $cart_product->quantity }}</td>
																				<td class="product-total">${{ $cart_product->total }}</td>
																			</tr>
																		@endforeach
																	</tbody>
																</table>
															</div>

															<br />

															<div class="total-section">
																<table class="total-table">
																	<thead class="total-table-head">
																		<tr class="table-total-row">
																			<th>Totals</th>
																			<th>Amount</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr class="total-data">
																			<td><strong>Subtotal: </strong></td>
																			<td data-subtotal="{{ $order->cart->subtotal }}" id="subtotal">${{ $cart->subtotal }}</td>
																		</tr>
																		<tr class="total-data">
																			<td><strong>Shipping: </strong></td>
																			<td data-shipping="{{ $order->cart->shipping }}" id="shipping">${{ $order->cart->shipping }}</td>
																		</tr>
																		<tr class="total-data">
																			<td><strong>Total: </strong></td>
																			<td data-total="{{ $order->cart->subtotal }}" id="total">${{ $order->cart->total }}</td>
																		</tr>
																	</tbody>
																</table>
															</div>

															<br />

															<div class="row">
																<div class="col-2">
																	<b>Status:</b>
																</div>
																<div class="col-10">
																	{{ $order->cart->status->status }}	
																</div>
															</div>

															<br />

															<div class="row">
																<div class="col-2">
																	<b>Shipping Address:</b>
																</div>
																<div class="col-10">
																	{{ $order->shipping_address->name }} <br />
																	{{ $order->shipping_address->email }} <br />
																	{{ $order->shipping_address->address }}
																</div>
															</div>
															
															<br />

															<div class="row">
																<div class="col-2">
																	<b>Status:</b>
																</div>
																<div class="col-10">
																	{{ $order->cart->status->status }}	
																</div>
															</div>															

														</div>
													</div>
												</div>
											@endforeach
										</div>
										</div>
										
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
								<form type="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
									@csrf
									<div class="checkout-accordion-wrap">
									<div class="accordion" id="accordionExample">
										@foreach($user->addresses as $address)
											<div class="accordion-item mb-5">
												<h6 class="accordion-header" id="headingOne">
													<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
														Order Number #{{ $order->order_number . ' - ' . Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->date)->format('M d, Y H:i') }}
													</button>
												</h6>
												<br />
												<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
													<div class="accordion-body">

																									
													</div>
												</div>
											</div>
										@endforeach
									</div>

									<div class="form-group fieldGroup">

										<div class="form-group row">
											<div class="col">
												<div class="row">
													<div class="col-2">
														<label for="description" class="form-label">Address Type: </label>
													</div>
													<div class="col-10">
														<input class="form-control" type="text" placeholder="Address Type (Home, Office, etc.)" name="description" id="description">													
													</div>
												</div>
											</div>	
											<div class="col">
												<div class="row">
													<div class="col-2">
														<label for="contact_person" class="">Contact Person: </label>
													</div>
													<div class="col-10">
														<input class="form-control" type="text" placeholder="Contact Person" name="contact_person" id="contact_person">													
													</div>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<div class="col-1">
												<label for="address1" class="">Address Line 1: </label>
											</div>
											<div class="col-11">
												<input class="form-control" type="text" placeholder="Address Line 1" name="address1" id="address1" value="">											
											</div>
										</div>

										<div class="form-group row">
											<div class="col-1">
												<label for="address2" class="">Address Line 2: </label>
											</div>
											<div class="col-11">
												<input class="form-control" type="text" placeholder="Address Line 2" name="address2" id="address2" value="">											
											</div>
										</div>

										<div class="form-group row">
											<div class="col">
												<div class="row">
													<div class="col-2">
														<label for="landmark" class="form-label">Landmark: </label>
													</div>
													<div class="col-10">
														<input class="form-control" type="text" placeholder="Landmark" name="landmark" id="landmark">													
													</div>
												</div>
											</div>	
											<div class="col">
												<div class="row">
													<div class="col-2">
														<label for="contact_phone" class="">Contact Phone: </label>
													</div>
													<div class="col-10">
														<input class="form-control" type="text" placeholder="Contact Phone" name="contact_phone" id="contact_phone">													
													</div>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<div class="col">
												<div class="row">
													<div class="col-2">
														<label for="district" class="form-label">District: </label>
													</div>
													<div class="col-10">
														<input class="form-control" type="text" placeholder="District" name="district" id="district">													
													</div>
												</div>
											</div>	
											<div class="col">
												<div class="row">
													<div class="col-2">
														<label for="city" class="">City: </label>
													</div>
													<div class="col-10">
														<input class="form-control" type="text" placeholder="City" name="city" id="city">													
													</div>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<div class="col">
												<div class="row">
													<div class="col-2">
														<label for="state" class="">State: </label>
													</div>
													<div class="col-10">
														<input class="form-control" type="text" placeholder="State" name="state" id="state">													
													</div>
												</div>
											</div>	
											<div class="col">
												<div class="row">
													<div class="col-2">
														<label for="country" class="">Country: </label>
													</div>
													<div class="col-10">
														<select id="country" name="country" class="form-control">
															<option value="0">-- Select Country --</option>
															@foreach($countries as $country)
																<option value="{{ $country->country_name }}" {{ $country->country_name == 'India' ? ' selected' : '' }}>{{ $country->country_name }}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>
										</div>

									</div>

									<p>
										<input class="pt-2 pb-2" style="font-size:12px; color:#fff" type="submit" value="Add Address">
										<input class="pt-2 pb-2" style="font-size:12px; color:#fff" type="submit" value="Update">
									</p>
								
								</form>

							</div>

							<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
								Some placeholder content in a paragraph relating to "Home". And some more content, used here just to pad out and fill this tab panel. In production, you would obviously have more real content here. And not just text. It could be anything, really. Text, images, forms.
							</div>
						  </div>
						</div>
					  </div>



				</div>
			</div>


		</div>
	</div>
	<!-- end team section -->

@endsection