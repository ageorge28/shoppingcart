@extends('layouts.app')

@php
    $title = 'Error';
    $cart = NULL;
    $companies = \App\Models\Company::all();
@endphp

@section('content')


<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<h1>Error</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<!-- latest news -->
<div class="latest-news mb-100">
	<div class="container">
		<div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div style="font-size:180px; font-weight:180px; color:#F28123">
                    404
                    <div style="font-size:48px">
                        Page Not Found 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection