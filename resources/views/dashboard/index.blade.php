@extends('dashboard.layouts.app')

@section('dashboard')

<div class="col-lg-2 mb-5">
    @include('dashboard.layouts.navigation')
  </div>
  <div class="col-lg-10">

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
                            <label for="email" class="">Email: <span style="color:red">*</span></label>
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
                        <img class="" style="height:50px" src="{{ asset('uploads') . '/' .  (!is_null($user->image) ? $user->image->filename : '') }}" />
                    </div>
                    <div class="col-9">
                        <input class="form-control" type="file" name="picture" id="picture">											
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-3">
                        <label for="phone" class="">Phone: <span style="color:red">*</span></label>
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

        <p class="mt-2"><input class="pt-2 pb-2" style="font-size:12px; color:#fff" type="submit" value="Update"></p>
    
    </form>

  </div>



@endsection