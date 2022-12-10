@extends('dashboard.layouts.app')

@section('dashboard')

<div class="col-lg-2 mb-5">
    @include('dashboard.layouts.navigation')
  </div>

  <div class="col-lg-10">

    <form method="POST" action="{{ route('address.store') }}">
									
        @csrf

        <div class="form-group fieldGroup">

            <div class="form-group row mb-2">
                <div class="col">
                    <div class="row">
                        <div class="col-4">
                            <label for="description" class="form-label">Address Type: </label>
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="text" placeholder="Address Type (Home, Office, etc.)" name="description" id="description">													
                        </div>
                    </div>
                </div>	
                <div class="col">
                    <div class="row">
                        <div class="col-4">
                            <label for="contact_person" class="">Contact Person: </label>
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="text" placeholder="Contact Person" name="contact_person" id="contact_person">													
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-2">
                <div class="col-2">
                    <label for="address1" class="">Address Line 1: </label>
                </div>
                <div class="col-10">
                    <input class="form-control" type="text" placeholder="Address Line 1" name="address1" id="address1" value="">											
                </div>
            </div>

            <div class="form-group row mb-2">
                <div class="col-2">
                    <label for="address2" class="">Address Line 2: </label>
                </div>
                <div class="col-10">
                    <input class="form-control" type="text" placeholder="Address Line 2" name="address2" id="address2" value="">											
                </div>
            </div>

            <div class="form-group row mb-2">
                <div class="col">
                    <div class="row">
                        <div class="col-4">
                            <label for="landmark" class="form-label">Landmark: </label>
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="text" placeholder="Landmark" name="landmark" id="landmark">													
                        </div>
                    </div>
                </div>	
                <div class="col">
                    <div class="row">
                        <div class="col-4">
                            <label for="contact_phone" class="">Contact Phone: </label>
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="text" placeholder="Contact Phone" name="contact_phone" id="contact_phone">													
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-2">
                <div class="col">
                    <div class="row">
                        <div class="col-4">
                            <label for="city" class="">City: </label>
                        </div>
                        <div class="col-8">                     
                            <select id="city" name="city" class="form-control">
                                <option value="0">-- Select City --</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                                @endforeach
                            </select>                     
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-4">
                            <label for="district" class="form-label">District: </label>
                        </div>
                        <div class="col-8">
                            <select id="district" name="district" class="form-control">
                                <option value="0">-- Select District --</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->district_title }}">{{ $district->district_title }}</option>
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
                            <label for="state" class="">State: </label>
                        </div>
                        <div class="col-8">
                            <select id="state" name="state" class="form-control">
                                <option value="0">-- Select State --</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->state_title }}">{{ $state->state_title }}</option>
                                @endforeach
                            </select>        
                        </div>
                    </div>
                </div>	
                <div class="col">
                    <div class="row">
                        <div class="col-4">
                            <label for="country" class="">Country: </label>
                        </div>
                        <div class="col-8">
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

        <p><input class="pt-2 pb-2" style="font-size:12px; color:#fff" type="submit" value="Save"></p>
    
    </form>

  </div>

@endsection