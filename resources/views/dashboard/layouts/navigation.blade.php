<div class="list-group" id="" role="">
    <a class="list-group-item list-group-item-action {{ request()->is('dashboard') ? 'active' : '' }}" id="list-home-list" href="{{ route('dashboard') }}" role="tab" aria-controls="list-home">My Account</a>
    <a class="list-group-item list-group-item-action {{ request()->is('dashboard/orders') ? 'active' : '' }}" id="list-profile-list" href="{{ route('orders') }}" aria-controls="list-profile">My Orders</a>
    <a class="list-group-item list-group-item-action {{ request()->is('dashboard/addresses') ? 'active' : '' }}" id="list-messages-list" href="{{ route('address') }}" aria-controls="list-messages">My Addresses</a>
</div>